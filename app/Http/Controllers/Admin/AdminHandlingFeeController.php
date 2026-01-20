<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class AdminHandlingFeeController extends Controller
{
    public function index()
    {
        $enabled = (int) Setting::get('handling_fee_enabled', 0) === 1;
        $percent = (float) Setting::get('handling_fee_percent', 10);
        $label   = (string) Setting::get('handling_fee_label', 'Handling Fee');

        // 伪造一个 “updated_at” 用来显示（取 settings 最后更新时间）
        $updatedAt = Setting::whereIn('key', [
            'handling_fee_enabled',
            'handling_fee_percent',
            'handling_fee_label',
        ])->max('updated_at');

        return view('admin.fees.handling', compact('enabled', 'percent', 'label', 'updatedAt'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'enabled' => ['nullable', 'boolean'],
            'percent' => ['required', 'numeric', 'min:0', 'max:100'],
            'label'   => ['nullable', 'string', 'max:50'],
        ]);

        Setting::set('handling_fee_enabled', !empty($data['enabled']) ? 1 : 0);
        Setting::set('handling_fee_percent', (float) $data['percent']);
        Setting::set('handling_fee_label', trim($data['label'] ?? 'Handling Fee') ?: 'Handling Fee');

        return back()->with('success', 'Handling fee updated.');
    }
}
