<x-app-layout>
    <section class="bg-[#FAF9F6] min-h-screen pb-20">

        {{-- Header Section --}}
        <div class="bg-white border-b border-gray-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-16 text-center">
                <h2 class="text-xs font-bold uppercase tracking-[0.3em] text-[#8f6a10] mb-3">Logistics</h2>
                <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 tracking-tight mb-4">
                    Shipping & Delivery
                </h1>
                <p class="text-sm text-gray-500 max-w-lg mx-auto leading-relaxed">
                    Everything you need to know about how we get your favorite items from our shop to your doorstep.
                </p>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-12">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">

                {{-- Left: Sidebar Help --}}
                <div class="space-y-6 lg:sticky lg:top-48 h-fit">

                    {{-- Content --}}
                    <div class="bg-white rounded-3xl p-6 text-gray-900 shadow-sm border border-gray-100">
                        <div class="flex items-center justify-between mb-4">
                            <p class="text-xs font-bold uppercase tracking-widest text-gray-500">Content</p>
                            <span
                                class="inline-flex items-center rounded-full border border-[#D4AF37]/25 bg-[#D4AF37]/10 px-2.5 py-1
                                         text-[10px] font-extrabold tracking-widest text-[#8f6a10] uppercase">
                                Policy
                            </span>
                        </div>

                        @php
                            $policyLinks = [
                                ['id' => 'p1', 'label' => '1) Scope & Acceptance'],
                                ['id' => 'p2', 'label' => '2) Product Categories'],
                                ['id' => 'p3', 'label' => '3) Order Processing'],
                                ['id' => 'p4', 'label' => '4) Shipping (Physical)'],
                                ['id' => 'p5', 'label' => '5) Digital Delivery'],
                                ['id' => 'p6', 'label' => '6) Risk & Proof of Delivery'],
                                ['id' => 'p7', 'label' => '7) Customer Responsibilities'],
                                ['id' => 'p8', 'label' => '8) Delivery Exceptions'],
                                ['id' => 'p9', 'label' => '9) Issue Reporting'],
                                ['id' => 'p10', 'label' => '10) Fees & Cross-Border'],
                                ['id' => 'p11', 'label' => '11) Disclaimers'],
                                ['id' => 'p12', 'label' => '12) Force Majeure'],
                                ['id' => 'p13', 'label' => '13) Related Policies'],
                                ['id' => 'p14', 'label' => '14) Contact & Support'],
                                ['id' => 'p15', 'label' => '15) Amendments'],
                            ];
                        @endphp

                        <div class="max-h-[360px] overflow-auto pr-1 space-y-2 text-sm">
                            @foreach ($policyLinks as $l)
                                <a href="#{{ $l['id'] }}"
                                    class="group flex items-center justify-between rounded-xl border border-gray-100 bg-gray-50 px-4 py-2.5
                                          text-gray-700 hover:bg-white hover:border-gray-200 transition">
                                    <span class="font-semibold truncate">{{ $l['label'] }}</span>
                                    <span class="text-[#8f6a10] opacity-0 group-hover:opacity-100 transition">→</span>
                                </a>
                            @endforeach
                        </div>

                        <p class="text-xs text-gray-500 mt-3 leading-relaxed">
                            Tip: Use Quick Jump for major sections, then use Content to jump within the Policy.
                        </p>
                    </div>
                </div>

                {{-- Right: Detailed Info --}}
                <div class="lg:col-span-2 space-y-12">

                    {{-- Shipping Rates Table --}}
                    {{-- <section id="shipping-rates" class="scroll-mt-24">
                        <div class="bg-white rounded-3xl p-8 text-gray-900 shadow-xl border border-black/5" id="track-order">
                        <h3 class="text-lg font-bold mb-4">Track Order</h3>

                        <p class="text-xs text-gray-500 mb-6 leading-relaxed">
                            Already have a tracking number? Enter it below to see the status.
                        </p>

                        <form action="#" class="space-y-3">
                            <input type="text" placeholder="e.g. MY123456789"
                                class="w-full bg-gray-50 border border-gray-200 rounded-xl
                                       px-4 py-3 text-sm text-gray-900 placeholder-gray-400
                                       focus:outline-none focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37]">

                            <button
                                class="w-full bg-[#D4AF37] hover:bg-[#b8962d]
                                       text-gray-900 font-bold py-3 rounded-xl text-sm transition-colors">
                                Track Now
                            </button>
                        </form>
                    </div>
                    </section> --}}

                    {{-- Important Notes --}}
                    <section id="things-to-note" class="space-y-6 scroll-mt-24">
                        <h2 class="text-xl font-bold text-gray-900">Things to Note</h2>

                        <div class="prose prose-sm text-gray-600 max-w-none space-y-4">
                            <p>
                                <strong>Tracking Your Order:</strong> Once your order has been dispatched, you will
                                receive an email containing a tracking link. Please allow up to 24 hours for the
                                tracking information to update.
                            </p>
                            <p>
                                <strong>Customs & Duties:</strong> For international orders (including Singapore),
                                please note that your order may be subject to import duties and taxes which are applied
                                when the delivery reaches that destination. We have no control over these charges.
                            </p>
                        </div>
                    </section>

                    {{-- Policy Section --}}
                    <section id="content" class="space-y-6 scroll-mt-24">

                        <div class="flex items-start justify-between gap-6">
                            <div>
                                <h2 class="text-xl font-bold text-gray-900 flex items-center gap-2">
                                    <span class="w-8 h-1 bg-[#D4AF37] rounded-full"></span>
                                    Shipping & Delivery Policy
                                </h2>
                                <p class="text-sm text-gray-500 mt-2 leading-relaxed">
                                    Please read this Policy together with our Terms & Conditions and Refund & Return
                                    Policy.
                                </p>
                            </div>

                            <span
                                class="shrink-0 inline-flex items-center rounded-full border border-[#D4AF37]/25 bg-[#D4AF37]/10
                                       px-3 py-1 text-[11px] font-extrabold tracking-widest text-[#8f6a10] uppercase">
                                Policy
                            </span>
                        </div>

                        {{-- 1 --}}
                        <div id="p1"
                            class="bg-white border border-gray-100 rounded-2xl shadow-sm p-7 scroll-mt-24">
                            <h3 class="text-base font-extrabold text-gray-900 tracking-tight">1) Scope & Acceptance</h3>
                            <div class="prose prose-sm max-w-none text-gray-600 mt-4">
                                <p>
                                    This Shipping & Delivery Policy (“Policy”) governs the delivery of physical and
                                    digital products purchased from
                                    BR Innovate Future Sdn. Bhd. (“BRIF”, “we”, “us”, or “our”) via our websites,
                                    subdomains, mobile applications, and
                                    other official sales channels (collectively, the “Platform”).
                                </p>
                                <p>
                                    By placing an order, you (“Customer”, “you”) acknowledge that you have read,
                                    understood, and agree to be bound by
                                    this Policy, our Terms & Conditions, and Refund & Return Policy.
                                </p>
                            </div>
                        </div>

                        {{-- 2 --}}
                        <div id="p2"
                            class="bg-white border border-gray-100 rounded-2xl shadow-sm p-7 scroll-mt-24">
                            <h3 class="text-base font-extrabold text-gray-900 tracking-tight">2) Product Categories &
                                Delivery Modes</h3>

                            <div class="mt-5 grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="rounded-2xl border border-gray-100 bg-gray-50 p-5">
                                    <p class="text-xs font-extrabold uppercase tracking-widest text-[#8f6a10] mb-2">2.1
                                        Physical Products</p>
                                    <p class="text-sm text-gray-600 leading-relaxed">
                                        Merchandise, hardware, printed materials, and other tangible goods are shipped
                                        from our warehouse(s) or directly
                                        from suppliers via reputable couriers.
                                    </p>
                                </div>

                                <div class="rounded-2xl border border-gray-100 bg-gray-50 p-5">
                                    <p class="text-xs font-extrabold uppercase tracking-widest text-[#8f6a10] mb-2">2.2
                                        Digital Products</p>
                                    <p class="text-sm text-gray-600 leading-relaxed">
                                        Mobile top-ups, e-vouchers, digital credits, insurance, consulting sessions, and
                                        other electronically delivered
                                        items are delivered via email, SMS, WhatsApp, or in-account delivery.
                                    </p>
                                    <p class="text-xs text-gray-500 mt-3 leading-relaxed">
                                        Note: Digital items may have activation/expiry rules and are typically
                                        non-returnable/non-refundable once delivered
                                        or accessed (see Refund & Return Policy).
                                    </p>
                                </div>
                            </div>
                        </div>

                        {{-- 3 --}}
                        <div id="p3"
                            class="bg-white border border-gray-100 rounded-2xl shadow-sm p-7 scroll-mt-24">
                            <h3 class="text-base font-extrabold text-gray-900 tracking-tight">3) Order Processing</h3>

                            <div class="mt-4 space-y-3 text-sm text-gray-600">
                                <div class="flex items-start gap-3">
                                    <span class="mt-1 w-1.5 h-1.5 rounded-full bg-[#D4AF37]"></span>
                                    <p><strong>Standard Handling Time:</strong> 1–3 business days (excludes weekends &
                                        Malaysian public holidays).</p>
                                </div>
                                <div class="flex items-start gap-3">
                                    <span class="mt-1 w-1.5 h-1.5 rounded-full bg-[#D4AF37]"></span>
                                    <p><strong>Cut-Off Times (GMT+8):</strong> Orders before 12:00 PM processed same
                                        business day; after 12:00 PM processed next business day.</p>
                                </div>
                                <div class="flex items-start gap-3">
                                    <span class="mt-1 w-1.5 h-1.5 rounded-full bg-[#D4AF37]"></span>
                                    <p><strong>Weekend orders:</strong> processed on Monday (or the next business day).
                                    </p>
                                </div>
                                <div class="flex items-start gap-3">
                                    <span class="mt-1 w-1.5 h-1.5 rounded-full bg-[#D4AF37]"></span>
                                    <p><strong>Inventory Day:</strong> No outbound shipments on the first Friday of each
                                        month.</p>
                                </div>
                                <div class="flex items-start gap-3">
                                    <span class="mt-1 w-1.5 h-1.5 rounded-full bg-[#D4AF37]"></span>
                                    <p><strong>Notifications:</strong> If delays occur (e.g., stock constraints, high
                                        volume, verification issues), we will notify you via email/SMS/WhatsApp.</p>
                                </div>
                                <div class="flex items-start gap-3">
                                    <span class="mt-1 w-1.5 h-1.5 rounded-full bg-[#D4AF37]"></span>
                                    <p><strong>Priority Handling:</strong> Available for bulk/corporate orders upon
                                        request (contact cs@brinnovatefuture.com).</p>
                                </div>
                                <div class="flex items-start gap-3">
                                    <span class="mt-1 w-1.5 h-1.5 rounded-full bg-[#D4AF37]"></span>
                                    <p>BRIF may require additional time for fraud screening or KYC/identity verification
                                        before release.</p>
                                </div>
                            </div>
                        </div>

                        {{-- 4 --}}
                        <div id="p4"
                            class="bg-white border border-gray-100 rounded-2xl shadow-sm p-7 scroll-mt-24">
                            <h3 class="text-base font-extrabold text-gray-900 tracking-tight">4) Shipping (Physical
                                Items)</h3>

                            <div class="mt-5 overflow-hidden border border-gray-100 rounded-2xl">
                                <table class="w-full text-left text-sm bg-white">
                                    <thead class="bg-gray-50 border-b border-gray-100">
                                        <tr>
                                            <th class="px-5 py-3 font-bold text-gray-900">Region</th>
                                            <th class="px-5 py-3 font-bold text-gray-900">Estimated Delivery Time</th>
                                            <th class="px-5 py-3 font-bold text-gray-900">Notes</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-50">
                                        <tr>
                                            <td class="px-5 py-4 font-semibold text-gray-700">West (Peninsular)
                                                Malaysia</td>
                                            <td class="px-5 py-4 text-gray-600">2–5 business days</td>
                                            <td class="px-5 py-4 text-gray-600">Free shipping on orders ≥ RM100</td>
                                        </tr>
                                        <tr>
                                            <td class="px-5 py-4 font-semibold text-gray-700">East Malaysia</td>
                                            <td class="px-5 py-4 text-gray-600">3–7 business days</td>
                                            <td class="px-5 py-4 text-gray-600">Shipping fee RM5–RM15</td>
                                        </tr>
                                        <tr>
                                            <td class="px-5 py-4 font-semibold text-gray-700">Singapore</td>
                                            <td class="px-5 py-4 text-gray-600">3–5 business days</td>
                                            <td class="px-5 py-4 text-gray-600">Flat shipping fee RM25</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="mt-5 text-sm text-gray-600 space-y-2">
                                <p><strong>Primary couriers</strong> include Pos Laju, J&T, and DHL.</p>
                                <p><strong>Tracking numbers</strong> are provided for all shipments.</p>
                                <p>Shipping cost is calculated at checkout by weight/volumetric weight, dimensions, and
                                    destination.</p>
                            </div>

                            <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="rounded-2xl border border-gray-100 bg-gray-50 p-5">
                                    <p class="text-xs font-extrabold uppercase tracking-widest text-[#8f6a10] mb-2">4.2
                                        Express Options (Peninsular Malaysia only)</p>
                                    <ul class="text-sm text-gray-600 space-y-2">
                                        <li>Same-Day Delivery (Klang Valley): Orders before 3:00 PM — RM15.</li>
                                        <li>Next-Day Delivery (Nationwide): RM10.</li>
                                        <li class="text-xs text-gray-500">Not available for East Malaysia or Singapore.
                                        </li>
                                    </ul>
                                </div>

                                <div class="rounded-2xl border border-gray-100 bg-gray-50 p-5">
                                    <p class="text-xs font-extrabold uppercase tracking-widest text-[#8f6a10] mb-2">
                                        4.3–4.4 Notes</p>
                                    <ul class="text-sm text-gray-600 space-y-2">
                                        <li>Oversized/heavy items may require special handling or incur surcharges.</li>
                                        <li>Remote/outlying areas may experience +1–2 business days.</li>
                                        <li>Orders may be split into multiple parcels for logistics efficiency or stock
                                            availability.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        {{-- 5 --}}
                        <div id="p5"
                            class="bg-white border border-gray-100 rounded-2xl shadow-sm p-7 scroll-mt-24">
                            <h3 class="text-base font-extrabold text-gray-900 tracking-tight">5) Digital Delivery
                                (Electronic Items)</h3>
                            <div class="mt-4 space-y-3 text-sm text-gray-600">
                                <p><strong>Standard Delivery Window:</strong> 1–24 hours after payment confirmation.</p>
                                <p><strong>Instant Processing:</strong> Many digital items are instant upon successful
                                    payment and system validation.</p>
                                <p><strong>Delivery Channels:</strong> Email / SMS / WhatsApp / In-Account. Ensure your
                                    contact details are accurate and check Spam/Junk folders.</p>
                                <p><strong>No Shipping Fees</strong> apply to digital items.</p>
                                <p><strong>Expiry/Activation:</strong> Some products have expiry dates or activation
                                    requirements; see product page and order confirmation.</p>
                            </div>

                            <div class="mt-6 rounded-2xl border border-[#D4AF37]/25 bg-[#D4AF37]/10 p-5">
                                <p class="text-xs font-extrabold uppercase tracking-widest text-[#8f6a10] mb-2">5.1
                                    Mobile Top-Ups (SLA Guidance)</p>
                                <ul class="text-sm text-gray-700 space-y-1">
                                    <li>Malaysia providers: typically instant.</li>
                                    <li>Singapore top-ups: processed within 4 hours.</li>
                                    <li class="text-gray-600">Confirmation will be sent to your email and/or mobile.
                                    </li>
                                </ul>
                            </div>
                        </div>

                        {{-- 6 --}}
                        <div id="p6"
                            class="bg-white border border-gray-100 rounded-2xl shadow-sm p-7 scroll-mt-24">
                            <h3 class="text-base font-extrabold text-gray-900 tracking-tight">6) Risk of Loss, Title &
                                Proof of Delivery</h3>
                            <div class="mt-4 space-y-3 text-sm text-gray-600">
                                <p><strong>Physical:</strong> Pass to Customer upon handover to courier or successful
                                    delivery scan, depending on courier terms.</p>
                                <p><strong>Proof of Delivery:</strong> Delivered status, recipient signature, photo
                                    proof, or OTP (if applicable) constitutes successful delivery.</p>
                                <p><strong>Digital:</strong> Delivery logs, successful transmission records, system
                                    receipts, or redemption confirmation constitute delivery.</p>
                            </div>
                        </div>

                        {{-- 7 --}}
                        <div id="p7"
                            class="bg-white border border-gray-100 rounded-2xl shadow-sm p-7 scroll-mt-24">
                            <h3 class="text-base font-extrabold text-gray-900 tracking-tight">7) Customer
                                Responsibilities</h3>
                            <ul class="mt-4 text-sm text-gray-600 space-y-2 list-disc pl-5">
                                <li>Provide accurate delivery/contact information (name, address, phone, email).</li>
                                <li>Ensure someone is available to receive/sign for the parcel at the delivery address.
                                </li>
                                <li>Notify BRIF immediately of any changes or delivery issues.</li>
                                <li>Monitor email/SMS/WhatsApp for delivery updates.</li>
                            </ul>

                            <div class="mt-5 rounded-2xl border border-gray-100 bg-gray-50 p-5">
                                <p class="text-sm text-gray-600 leading-relaxed">
                                    BRIF is not liable for deliveries to incorrect/incomplete addresses provided by the
                                    Customer, failed delivery due to no recipient,
                                    or Customer’s failure to collect from courier/locker. Re-delivery/return charges
                                    (RM10–RM20 or courier rate) may apply.
                                </p>
                            </div>
                        </div>

                        {{-- 8 --}}
                        <div id="p8"
                            class="bg-white border border-gray-100 rounded-2xl shadow-sm p-7 scroll-mt-24">
                            <h3 class="text-base font-extrabold text-gray-900 tracking-tight">8) Delivery Exceptions &
                                Undeliverable Parcels</h3>
                            <div class="mt-4 text-sm text-gray-600 space-y-2">
                                <p><strong>Failed/Refused Delivery:</strong> Returned parcels may incur return shipping
                                    and re-delivery fees.</p>
                                <p><strong>Unclaimed Parcels:</strong> If unclaimed within courier holding period,
                                    parcels may be returned to sender.</p>
                                <p><strong>Address Corrections:</strong> Post-dispatch changes not guaranteed;
                                    additional fees/delays may apply.</p>
                                <p><strong>Force Majeure:</strong> See §12.</p>
                            </div>
                        </div>

                        {{-- 9 --}}
                        <div id="p9"
                            class="bg-white border border-gray-100 rounded-2xl shadow-sm p-7 scroll-mt-24">
                            <h3 class="text-base font-extrabold text-gray-900 tracking-tight">9) Issue Reporting &
                                Resolution</h3>

                            <div class="mt-5 grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="rounded-2xl border border-gray-100 bg-gray-50 p-5">
                                    <p class="text-xs font-extrabold uppercase tracking-widest text-[#8f6a10] mb-2">9.1
                                        Physical Items</p>
                                    <ul class="text-sm text-gray-600 space-y-2">
                                        <li><strong>Report Window:</strong> Within 48 hours of marked delivery.</li>
                                        <li><strong>Evidence Required:</strong> Photos of box, inner packaging, label,
                                            damaged/incorrect item.</li>
                                        <li>Keep all packaging until case closure.</li>
                                        <li>Return may be required for inspection before exchange/refund.</li>
                                    </ul>
                                </div>

                                <div class="rounded-2xl border border-gray-100 bg-gray-50 p-5">
                                    <p class="text-xs font-extrabold uppercase tracking-widest text-[#8f6a10] mb-2">9.2
                                        Digital Items</p>
                                    <ul class="text-sm text-gray-600 space-y-2">
                                        <li>Check Spam/Junk folders.</li>
                                        <li>Contact us if not received within 24 hours of payment confirmation.</li>
                                        <li>Provide screenshots of error/incorrect item/failed redemption.</li>
                                    </ul>
                                </div>
                            </div>

                            <div class="mt-5 rounded-2xl border border-[#D4AF37]/25 bg-[#D4AF37]/10 p-5">
                                <p class="text-sm text-gray-700 leading-relaxed">
                                    <strong>9.3 Resolution Timeline:</strong> Most cases resolved within 3–5 business
                                    days; complex investigations may take up to 14 business days.
                                </p>
                            </div>
                        </div>

                        {{-- 10 --}}
                        <div id="p10"
                            class="bg-white border border-gray-100 rounded-2xl shadow-sm p-7 scroll-mt-24">
                            <h3 class="text-base font-extrabold text-gray-900 tracking-tight">10) Fees, Taxes &
                                Cross-Border</h3>
                            <div class="mt-4 text-sm text-gray-600 space-y-2">
                                <p><strong>Duties/Taxes (Singapore):</strong> Recipient responsible for any import
                                    duties, GST, or clearance fees.</p>
                                <p><strong>Surcharges:</strong> Remote area, special handling, re-delivery, storage,
                                    address correction fees may apply.</p>
                                <p><strong>Displayed Rates:</strong> Checkout rates are estimates; adjustments may occur
                                    for oversize/volumetric items (you will be notified).</p>
                            </div>
                        </div>

                        {{-- 11 --}}
                        <div id="p11"
                            class="bg-white border border-gray-100 rounded-2xl shadow-sm p-7 scroll-mt-24">
                            <h3 class="text-base font-extrabold text-gray-900 tracking-tight">11) Service Levels &
                                Disclaimers</h3>
                            <ul class="mt-4 text-sm text-gray-600 space-y-2 list-disc pl-5">
                                <li>Timelines are indicative and not guaranteed; delays may arise from couriers,
                                    weather, customs, systems, peak seasons.</li>
                                <li>BRIF not liable for indirect or consequential losses resulting from delays.</li>
                                <li>Pre-orders/backorders ship upon stock arrival; estimated dates subject to change.
                                </li>
                                <li>BRIF may hold orders pending fraud/KYC checks or clarify unusual transactions.</li>
                            </ul>
                        </div>

                        {{-- 12 --}}
                        <div id="p12"
                            class="bg-white border border-gray-100 rounded-2xl shadow-sm p-7 scroll-mt-24">
                            <h3 class="text-base font-extrabold text-gray-900 tracking-tight">12) Events Beyond Our
                                Control (Force Majeure)</h3>
                            <p class="text-sm text-gray-600 mt-4 leading-relaxed">
                                We shall not be liable for delay or non-performance caused by events beyond our
                                reasonable control, including natural disasters,
                                regulatory actions, strikes, pandemics, utility outages, systemic courier disruptions,
                                or supply-chain failures. Delivery will resume as soon
                                as reasonably practicable.
                            </p>
                        </div>

                        {{-- 13 --}}
                        <div id="p13"
                            class="bg-white border border-gray-100 rounded-2xl shadow-sm p-7 scroll-mt-24">
                            <h3 class="text-base font-extrabold text-gray-900 tracking-tight">13) Relationship to Other
                                Policies</h3>
                            <p class="text-sm text-gray-600 mt-4 leading-relaxed">
                                This Policy forms part of BRIF’s Terms & Conditions and must be read together with the
                                Privacy Policy and Refund & Return Policy.
                                If any inconsistency occurs, Terms & Conditions prevail, followed by Refund & Return
                                Policy for refund/return matters.
                            </p>
                        </div>

                        {{-- 14 --}}
                        <div id="p14"
                            class="bg-white border border-gray-100 rounded-2xl shadow-sm p-7 scroll-mt-24">
                            <h3 class="text-base font-extrabold text-gray-900 tracking-tight">14) Contact & Support
                            </h3>

                            <div class="mt-5 grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div class="rounded-2xl border border-gray-100 bg-gray-50 p-5">
                                    <p class="text-xs font-extrabold uppercase tracking-widest text-[#8f6a10] mb-2">
                                        Shipping & Delivery Support</p>
                                    <div class="text-sm text-gray-600 space-y-2">
                                        <p><strong>Email:</strong> cs@brinnovatefuture.com</p>
                                        <p><strong>WhatsApp:</strong> +60 12-301 1610</p>
                                        <p><strong>Office:</strong> Selangor, Malaysia</p>
                                    </div>
                                </div>

                                <div class="rounded-2xl border border-gray-100 bg-gray-50 p-5">
                                    <p class="text-xs font-extrabold uppercase tracking-widest text-[#8f6a10] mb-2">
                                        Customer Support Hours</p>
                                    <div class="text-sm text-gray-600 space-y-2">
                                        <p><strong>Monday – Sunday:</strong> 9:00 AM – 10:00 PM (GMT+8)</p>
                                        <p class="text-xs text-gray-500 leading-relaxed">
                                            (Order processing occurs on business days; no outbound shipments on the
                                            first Friday of each month due to inventory.)
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- 15 --}}
                        <div id="p15"
                            class="bg-white border border-gray-100 rounded-2xl shadow-sm p-7 scroll-mt-24">
                            <h3 class="text-base font-extrabold text-gray-900 tracking-tight">15) Amendments</h3>
                            <p class="text-sm text-gray-600 mt-4 leading-relaxed">
                                We may update this Policy at any time to reflect operational changes, legal
                                requirements, or courier policies. Continued ordering after changes
                                constitutes acceptance of the updated Policy.
                            </p>
                        </div>

                    </section>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
