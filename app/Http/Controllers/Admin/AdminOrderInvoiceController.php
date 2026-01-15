<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminOrderInvoiceController extends Controller
{
    public function pdf(Request $request, Order $order)
    {
        $order->load(['items.product']);

        $pdf = Pdf::loadView('admin.orders.invoice_pdf', compact('order'))
            ->setPaper('a4', 'portrait');

        $filename = 'invoice-' . $order->order_no . '.pdf';

        // 下载
        // return $pdf->download($filename);

        // 如果你要直接在浏览器打开（预览）用这行：
        return $pdf->stream($filename);
    }
}
