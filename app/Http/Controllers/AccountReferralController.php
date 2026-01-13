<?php

namespace App\Http\Controllers;

use App\Models\ReferralLog;
use App\Models\PointTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AccountReferralController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $refLink = url('/register?ref=' . $user->referral_code);

        $referrals = ReferralLog::with(['referredUser:id,name,email,created_at'])
            ->where('referrer_id', $user->id)
            ->latest()
            ->paginate(12)
            ->withQueryString();

        $stats = [
            'total' => ReferralLog::where('referrer_id', $user->id)->count(),
            'points' => (int) $user->points_balance,
        ];

        $pointTransactions = PointTransaction::with([
            'referralLog.referredUser:id,name,email',
            'order:id,order_no',
        ])
            ->where('user_id', $user->id)
            ->where('source', 'referral')
            ->latest()
            ->paginate(10)
            ->withQueryString();



        return view('account.referral.index', compact(
            'user',
            'stats',
            'referrals',
            'pointTransactions'
        ));
    }
}
