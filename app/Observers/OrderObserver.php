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
            $this->handlePurchasePoints($order); // ✅ 买家 cashback
            $this->handleReferralPoints($order); // ✅ 上级 referral（你原本的）
        }
    }

    protected function handleReferralPoints(Order $order): void
    {
        $buyer = $order->user;

        if (!$buyer || !$buyer->referred_by) return;

        $log = ReferralLog::where('referrer_id', $buyer->referred_by)
            ->where('referred_user_id', $buyer->id)
            ->first();

        if (!$log) return;

        // 已奖励过就不跑了（一次性玩法）
        if ($log->rewarded) return;

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

    protected function handlePurchasePoints(Order $order): void
    {
        $buyer = $order->user;
        if (!$buyer) return;

        // RM1 = 1 point（向下取整）
        $points = (int) floor($order->total);
        if ($points <= 0) return;

        app(PointsService::class)->creditPurchase(
            $buyer,
            $order,
            $points,
            'Purchase cashback (RM 1 = 1 point)'
        );
    }
}
