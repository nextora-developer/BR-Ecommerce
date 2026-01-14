<?php

namespace App\Services;

use App\Models\PointTransaction;
use App\Models\ReferralLog;
use App\Models\User;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class PointsService
{
    /**
     * 一次性 referral reward（首单 completed）
     * 同时记录触发的订单 order_id，方便 admin 对账
     */
    public function creditReferral(
        User $referrer,
        ReferralLog $log,
        Order $order,
        int $points,
        string $note
    ): bool {
        return DB::transaction(function () use ($referrer, $log, $order, $points, $note) {

            // ✅ 防重复：这个 referral 已经 rewarded 过
            if ($log->rewarded) {
                return false;
            }

            // 🔒 锁住 referrer，避免并发重复加 points
            $lockedUser = User::whereKey($referrer->id)
                ->lockForUpdate()
                ->first();

            // ✅ 建立 points transaction（保留 order_id）
            PointTransaction::create([
                'user_id'         => $lockedUser->id,
                'type'            => 'earn',
                'source'          => 'referral',
                'referral_log_id' => $log->id,
                'order_id'        => $order->id, // ✅ 记录触发订单
                'points'          => $points,
                'note'            => $note,
            ]);

            // ✅ 累加 points balance
            $lockedUser->increment('points_balance', $points);

            // ✅ 标记 referral 已经 rewarded（并记录触发订单）
            $log->update([
                'rewarded'      => true,
                'reward_type'   => 'points',
                'reward_amount' => $points,
                'order_id'      => $order->id,   // ✅ 记录首单
            ]);

            return true;
        });
    }

    public function creditPurchase(
        User $buyer,
        Order $order,
        int $points,
        string $note = 'Purchase cashback (RM 1 = 1 point)'
    ): bool {
        return DB::transaction(function () use ($buyer, $order, $points, $note) {

            // ✅ 防重复：同一张订单的 purchase cashback 只发一次
            $exists = PointTransaction::where('source', 'purchase')
                ->where('order_id', $order->id)
                ->where('user_id', $buyer->id)
                ->exists();

            if ($exists) return false;

            $lockedBuyer = User::whereKey($buyer->id)->lockForUpdate()->first();

            PointTransaction::create([
                'user_id'  => $lockedBuyer->id,
                'type'     => 'earn',
                'source'   => 'purchase',
                'order_id' => $order->id,
                'points'   => $points,
                'note'     => $note,
            ]);

            $lockedBuyer->increment('points_balance', $points);

            return true;
        });
    }
}
