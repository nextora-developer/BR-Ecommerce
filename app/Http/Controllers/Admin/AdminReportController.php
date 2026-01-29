<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class AdminReportController extends Controller
{
    private function resolveRange(Request $request): array
    {
        $range = $request->get('range', '30d');
        $startDateInput = $request->get('start_date');
        $endDateInput   = $request->get('end_date');

        $end   = now();
        $start = now()->subDays(29)->startOfDay();
        $label = 'Last 30 Days';

        switch ($range) {
            case 'today':
                $start = now()->startOfDay();
                $end   = now()->endOfDay();
                $label = 'Today';
                break;

            case '7d':
                $start = now()->subDays(6)->startOfDay();
                $end   = now()->endOfDay();
                $label = 'Last 7 Days';
                break;

            case '30d':
                $start = now()->subDays(29)->startOfDay();
                $end   = now()->endOfDay();
                $label = 'Last 30 Days';
                break;

            case 'custom':
                if ($startDateInput && $endDateInput) {
                    $start = Carbon::parse($startDateInput)->startOfDay();
                    $end   = Carbon::parse($endDateInput)->endOfDay();
                    $label = $start->format('d M Y') . ' - ' . $end->format('d M Y');
                } else {
                    $range = '30d';
                }
                break;
        }

        return [$range, $start, $end, $label];
    }

    public function index(Request $request)
    {
        // 1) 时间范围
        [$activeRange, $start, $end, $reportRangeLabel] = $this->resolveRange($request);

        /**
         * 2) 基础订单 query（用于“订单结构分析”）
         * 你之后如果有 paid_at，可以改为 whereBetween('paid_at', ...)
         */
        $ordersQuery = Order::query()
            ->whereNotNull('created_at')
            ->whereBetween('created_at', [$start, $end]);

        /**
         * ✅ 3) Revenue Orders（用于“钱相关指标”）
         * 只算已入账/有效状态的订单
         */
        $revenueOrdersQuery = (clone $ordersQuery)->revenue();

        // ✅ 4) Total Sales（只算 revenue）
        $totalSales = (clone $revenueOrdersQuery)->sum('total');

        // ✅ 5) Total Orders（两种做法：我这里用“所有订单数”，更适合运营报表）
        $totalOrders = (clone $ordersQuery)->count();

        // ✅ 6) Orders per Day（基于 totalOrders：表示下单频率）
        $days = max($start->diffInDays($end) + 1, 1);
        $ordersPerDay = $days > 0 ? $totalOrders / $days : 0;

        // ✅ 7) Average Order Value（AOV：必须用 revenue 订单来算）
        $revenueOrdersCount = (clone $revenueOrdersQuery)->count();
        $averageOrderValue = $revenueOrdersCount > 0
            ? $totalSales / $revenueOrdersCount
            : 0;

        // 8) New Customers
        $newCustomers = User::query()
            ->where('is_admin', false)
            ->whereBetween('created_at', [$start, $end])
            ->count();

        // 9) Sales by Status（结构分析：不 filter）
        $salesByStatusCollection = (clone $ordersQuery)
            ->selectRaw('status, COUNT(*) as orders, SUM(total) as total')
            ->groupBy('status')
            ->get();

        $salesByStatus = $salesByStatusCollection
            ->mapWithKeys(function ($row) {
                return [
                    $row->status => [
                        'orders' => (int) $row->orders,
                        'total'  => (float) $row->total,
                    ],
                ];
            })
            ->toArray();

        // ✅ 10) Sales by Payment Method（钱相关：要 filter revenue）
        $salesByPaymentCollection = (clone $revenueOrdersQuery)
            ->selectRaw('payment_method_name as payment_method, COUNT(*) as orders, SUM(total) as total')
            ->groupBy('payment_method_name')
            ->get();

        $salesByPayment = $salesByPaymentCollection
            ->mapWithKeys(function ($row) {
                return [
                    $row->payment_method ?? 'Unknown' => [
                        'orders' => (int) $row->orders,
                        'total'  => (float) $row->total,
                    ],
                ];
            })
            ->toArray();

        // ✅ 11) Top Products（钱相关：必须 filter revenue）
        $topProducts = DB::table('order_items')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->whereNotNull('orders.created_at')
            ->whereBetween('orders.created_at', [$start, $end])
            ->whereIn('orders.status', Order::REVENUE_STATUSES)
            ->selectRaw('products.name as name, SUM(order_items.qty) as qty, SUM(order_items.unit_price) as total')
            ->groupBy('products.name')
            ->orderByDesc('qty')
            ->limit(10)
            ->get()
            ->map(function ($row) {
                return [
                    'name'  => $row->name,
                    'qty'   => (int) $row->qty,
                    'total' => (float) $row->total,
                ];
            })
            ->toArray();

        return view('admin.reports.index', [
            'activeRange'        => $activeRange,
            'reportRangeLabel'   => $reportRangeLabel,
            'totalSales'         => $totalSales,
            'totalOrders'        => $totalOrders,
            'ordersPerDay'       => $ordersPerDay,
            'averageOrderValue'  => $averageOrderValue,
            'newCustomers'       => $newCustomers,
            'salesByStatus'      => $salesByStatus,
            'salesByPayment'     => $salesByPayment,
            'topProducts'        => $topProducts,
        ]);
    }

    public function export(Request $request)
    {
        // 1) 时间范围
        [$range, $start, $end, $reportRangeLabel] = $this->resolveRange($request);

        // 2) 基础订单 query（导出通常也建议只导 revenue；我这里导 revenue daily sales）
        $ordersQuery = Order::query()
            ->whereNotNull('created_at')
            ->whereBetween('created_at', [$start, $end]);

        $revenueOrdersQuery = (clone $ordersQuery)->revenue();

        // 3) 按天汇总（revenue）
        $rawDaily = (clone $revenueOrdersQuery)
            ->selectRaw('DATE(created_at) as date, COUNT(*) as orders, SUM(total) as total')
            ->groupBy(DB::raw('DATE(created_at)'))
            ->orderBy('date')
            ->get()
            ->keyBy('date');

        // 4) 填补没订单的天
        $period = CarbonPeriod::create(
            $start->copy()->startOfDay(),
            $end->copy()->startOfDay()
        );

        $dailyStats = [];

        foreach ($period as $date) {
            $key = $date->format('Y-m-d');
            $row = $rawDaily->get($key);

            $ordersCount = $row ? (int) $row->orders : 0;
            $totalSales  = $row ? (float) $row->total : 0.0;
            $avgOrder    = $ordersCount > 0 ? $totalSales / $ordersCount : 0.0;

            $dailyStats[] = [
                'date'        => $key,
                'orders'      => $ordersCount,
                'total_sales' => $totalSales,
                'avg_order'   => $avgOrder,
            ];
        }

        // 5) CSV
        $filename = 'daily_sales_' . now()->format('Ymd_His') . '.csv';

        $headers = [
            'Content-Type'        => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $callback = function () use ($dailyStats, $reportRangeLabel) {
            $handle = fopen('php://output', 'w');

            fputcsv($handle, ['Daily Sales Report (Revenue Only)', $reportRangeLabel]);
            fputcsv($handle, []);

            fputcsv($handle, ['Date', 'Orders', 'Total Sales', 'Average Order Value']);

            foreach ($dailyStats as $day) {
                fputcsv($handle, [
                    $day['date'],
                    $day['orders'],
                    number_format($day['total_sales'], 2, '.', ''),
                    number_format($day['avg_order'], 2, '.', ''),
                ]);
            }

            fclose($handle);
        };

        return response()->streamDownload($callback, $filename, $headers);
    }
}
