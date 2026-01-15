<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class AccountOrderInvoiceController extends Controller
{
    public function pdf(Request $request, Order $order)
    {
        // ✅ 安全：只能下载自己的订单
        abort_unless($order->user_id === auth()->id(), 403);

        $order->load(['items.product']);

        $pdf = Pdf::loadView('account.orders.invoice_pdf', compact('order'))
            ->setPaper('a4', 'portrait');

        $filename = 'invoice-' . $order->order_no . '.pdf';

        // return $pdf->download($filename);
        // 要预览就用：
        return $pdf->stream($filename);
    }
}
