<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Invoice #{{ $order->order_no }}</title>
    <style>
        /* PDF engines prefer specific font declarations */
        @page {
            margin: 0px;
        }

        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 11px;
            color: #333;
            margin: 0;
            padding: 0;
            line-height: 1.5;
        }

        .wrap {
            padding: 40px;
        }

        /* Header & Branding */
        .header-table {
            width: 100%;
            border-bottom: 2px solid #111;
            padding-bottom: 20px;
        }

        .brand-name {
            font-size: 15px;
            font-weight: 800;
            letter-spacing: -0.2px;
            color: #111;
            line-height: 1.15;
        }


        .invoice-label {
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 3px;
            color: #8f6a10;
            font-weight: 700;
        }

        /* Layout Helpers */
        .row {
            width: 100%;
        }

        .mt-lg {
            margin-top: 30px;
        }

        .mt-md {
            margin-top: 15px;
        }

        .muted {
            color: #777;
        }

        /* Information Blocks */
        .info-table {
            width: 100%;
        }

        .info-box-label {
            font-size: 9px;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: #999;
            margin-bottom: 6px;
            display: block;
        }

        /* Items Table */
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 25px;
        }

        .items-table th {
            background: #111;
            color: #fff;
            padding: 12px 10px;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
            border: none;
        }

        .items-table td {
            padding: 15px 10px;
            border-bottom: 1px solid #eee;
            vertical-align: top;
        }

        .product-name {
            font-size: 12px;
            font-weight: 700;
            color: #111;
            display: block;
        }

        .product-variant {
            font-size: 10px;
            color: #8f6a10;
            margin-top: 3px;
        }

        /* Totals Area */
        .totals-table {
            width: 100%;
            margin-top: 20px;
        }

        .total-row td {
            padding: 4px 0;
        }

        .grand-total-label {
            font-size: 14px;
            font-weight: 800;
            color: #111;
            padding-top: 15px !important;
        }

        .grand-total-amount {
            font-size: 18px;
            font-weight: 800;
            color: #8f6a10;
            padding-top: 15px !important;
        }

        /* Utilities */
        .right {
            text-align: right;
        }

        .left {
            text-align: left;
        }

        .center {
            text-align: center;
        }

        .border-box {
            border: 1px solid #efefef;
            padding: 15px;
            border-radius: 8px;
        }
    </style>
</head>

<body>

    @php
        $fullAddress = trim(
            ($order->address_line1 ?? '') .
                "\n" .
                ($order->address_line2 ? $order->address_line2 . "\n" : '') .
                ($order->postcode ?? '') .
                ' ' .
                ($order->city ?? '') .
                "\n" .
                ($order->state ?? '') .
                "\n" .
                ($order->country ?? ''),
        );
        $issuedAt = $order->created_at?->format('d M Y, H:i') ?? now()->format('d M Y, H:i');
    @endphp

    <div class="wrap">
        {{-- Header Section --}}
        <table class="header-table">
            <tr>
                <td>
                    <span class="invoice-label">Official Invoice</span>
                    <h1 style="margin: 5px 0 0 0; font-size: 28px;">#{{ $order->order_no }}</h1>
                </td>
                <td class="right">
                    <div class="brand-name">BR Innovate Future Sdn. Bhd.</div>
                    <div class="muted" style="font-size: 12px;">
                        1592246-D<br>
                        cs@brinnovatefuture.com
                    </div>
                </td>
            </tr>
        </table>

        {{-- Metadata Section --}}
        <table class="row mt-md">
            <tr>
                <td style="width: 33%;">
                    <span class="info-box-label">Date Issued</span>
                    <b>{{ $issuedAt }}</b>
                </td>
                <td style="width: 33%;" class="center">
                    <span class="info-box-label">Payment Method</span>
                    <b>{{ strtoupper($order->payment_method_name ?? 'Online') }}</b>
                </td>
                <td style="width: 33%;" class="right">
                    <span class="info-box-label">Order Status</span>
                    <b style="color: #8f6a10;">{{ strtoupper($order->status ?? 'paid') }}</b>
                </td>
            </tr>
        </table>

        {{-- Billing & Shipping Section --}}
        <table class="row mt-lg" style="background: #fafafa; border-radius: 12px;">
            <tr>
                <td style="width: 50%; padding: 20px; vertical-align: top; border-right: 2px white solid;">
                    <span class="info-box-label">Bill To</span>
                    <div style="font-size: 13px; font-weight: 700;">{{ $order->customer_name ?? '-' }}</div>
                    <div class="muted">{{ $order->customer_email ?? '—' }}</div>
                    <div class="muted">{{ $order->customer_phone ?? '—' }}</div>
                </td>
                <td style="width: 50%; padding: 20px; vertical-align: top;">
                    <span class="info-box-label">Ship To</span>
                    <div style="font-size: 11px; line-height: 1.4; white-space: pre-line;">{{ $fullAddress ?: '—' }}
                    </div>
                </td>
            </tr>
        </table>

        {{-- Products Table --}}
        <table class="items-table">
            <thead>
                <tr>
                    <th class="left" style="width: 50%">Description</th>
                    <th class="center">Qty</th>
                    <th class="right">Price</th>
                    <th class="right">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->items as $item)
                    <tr>
                        <td>
                            <span
                                class="product-name">{{ $item->product_name ?? ($item->product->name ?? 'Product') }}</span>
                            @if ($item->variant_label || $item->variant_value)
                                <div class="product-variant">
                                    {{ trim(($item->variant_label ?? '') . ': ' . ($item->variant_value ?? '')) }}
                                </div>
                            @endif
                        </td>
                        <td class="center" style="font-weight: 700;">{{ $item->qty ?? 1 }}</td>
                        <td class="right">RM {{ number_format((float) $item->unit_price, 2) }}</td>
                        <td class="right" style="font-weight: 700;">RM {{ number_format((float) $item->subtotal, 2) }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Footer Summary --}}
        <table class="row mt-lg">
            <tr>
                {{-- Remarks --}}
                <td style="width: 50%; vertical-align: top; padding-right: 40px;">
                    @if ($order->remark)
                        <span class="info-box-label">Customer Note</span>
                        <p style="margin-top: 5px; font-style: italic;" class="muted">{{ trim($order->remark) }}</p>
                    @endif
                </td>

                {{-- Calculations --}}
                <td style="width: 50%; vertical-align: top;">
                    <table class="totals-table">
                        <tr class="total-row">
                            <td class="muted">Subtotal</td>
                            <td class="right">RM {{ number_format((float) ($order->subtotal ?? 0), 2) }}</td>
                        </tr>
                        <tr class="total-row">
                            <td class="muted">Shipping Fee</td>
                            <td class="right">
                                {{ ($order->shipping_fee ?? 0) > 0 ? 'RM ' . number_format((float) $order->shipping_fee, 2) : 'FREE' }}
                            </td>
                        </tr>

                        @if (($order->voucher_discount ?? 0) > 0)
                            <tr class="total-row">
                                <td class="muted">Voucher Discount</td>
                                <td class="right" style="color: #d11212;">- RM
                                    {{ number_format((float) $order->voucher_discount, 2) }}</td>
                            </tr>
                        @endif

                        @if (($order->points_discount ?? 0) > 0)
                            <tr class="total-row">
                                <td class="muted">Points Redeemed</td>
                                <td class="right" style="color: #d11212;">- RM
                                    {{ number_format((float) $order->points_discount, 2) }}</td>
                            </tr>
                        @endif

                        <tr>
                            <td class="grand-total-label">Grand Total</td>
                            <td class="right grand-total-amount">RM
                                {{ number_format((float) ($order->total ?? 0), 2) }}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        {{-- Fine Print --}}
        <div style="margin-top: 60px; text-align: center; border-top: 1px solid #eee; padding-top: 20px;">
            <p class="muted" style="font-size: 9px; letter-spacing: 1px; text-transform: uppercase;">
                This is a computer-generated document. <br>
                Power by BR Innovate Future Sdn. Bhd.
            </p>
        </div>
    </div>

</body>

</html>
