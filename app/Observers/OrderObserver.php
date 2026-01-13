<?php

namespace App\Observers;

use App\Models\Order;
use App\Models\ReferralLog;
use App\Services\PointsService;

class OrderObserver
{
    public function updated(Order $order): void
    {
        if ($order->isDirty('status') && $order->status === 'completed') {
            $this->handleReferralPoints($order);
        }
    }

    protected function handleReferralPoints(Order $order): void
    {
        $buyer = $order->user;

        if (!$buyer || !$buyer->referred_by) return;

        $log = ReferralLog::where('referrer_id', $buyer->referred_by)
            ->where('referred_user_id', $buyer->id)
            ->first();

        // ✅ 关系不存在就跳过，但不要再用 rewarded 挡
        if (!$log) return;

        // RM 1 = 1 point（向下取整）
        $points = (int) floor($order->total);
        if ($points <= 0) return;

        app(PointsService::class)->creditReferral(
            $buyer->referrer,
            $log,
            $order,
            $points,
            'Referral first order completed (RM 1 = 1 point)'
        );
    }
}
