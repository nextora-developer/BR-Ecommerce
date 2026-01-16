<?php

namespace App\Jobs;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class MarkPendingOrderFailedIfUnpaid implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public int $orderId) {}

    public function handle(): void
    {
        $order = Order::find($this->orderId);
        if (!$order) return;

        $status = strtolower((string) $order->status);

        if ($status === 'pending') {
            $order->update(['status' => 'failed']);

            Log::info('RM: auto-mark pending order as failed (unpaid after return)', [
                'order_no' => $order->order_no,
                'order_id' => $order->id,
            ]);
        }
    }
}
