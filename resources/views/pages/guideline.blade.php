<x-app-layout>
    <section class="bg-[#FAF9F6] min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-20">

            {{-- Header --}}
            <div class="text-center mb-20">
                <div
                    class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#D4AF37]/10 text-[#8f6a10] text-xs font-bold uppercase tracking-wider mb-4">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Help Center
                </div>
                <h1 class="text-4xl sm:text-5xl font-extrabold text-gray-900 tracking-tight mb-4">
                    Guideline
                </h1>
                <p class="text-gray-500 max-w-xl mx-auto text-lg leading-relaxed">
                    Everything you need to know about using our platform, simplified in one place.
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-4 gap-12 items-start">

                {{-- Left Navigation --}}
                <aside class="lg:col-span-1 lg:sticky lg:top-48">
                    <nav class="space-y-2" id="guide-nav">
                        @php
                            $menus = [
                                [
                                    'id' => 'order',
                                    'label' => 'How to Order',
                                    'icon' => 'M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z',
                                ],
                                [
                                    'id' => 'verify',
                                    'label' => 'Verify Account',
                                    'icon' =>
                                        'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z',
                                ],
                                [
                                    'id' => 'language',
                                    'label' => 'Switch Language',
                                    'icon' =>
                                        'm10.5 21 5.25-11.25L21 21m-9-3h7.5M3 5.621a48.474 48.474 0 0 1 6-.371m0 0c1.12 0 2.233.038 3.334.114M9 5.25V3m3.334 2.364C11.176 10.658 7.69 15.08 3 17.502m9.334-12.138c.896.061 1.785.147 2.666.257m-4.589 8.495a18.023 18.023 0 0 1-3.827-5.802',
                                ],
                                [
                                    'id' => 'check-order',
                                    'label' => 'Check Order',
                                    'icon' =>
                                        'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01',
                                ],
                            ];
                        @endphp

                        @foreach ($menus as $menu)
                            <a href="#{{ $menu['id'] }}"
                                class="guide-link group flex items-center gap-3 px-5 py-4 rounded-2xl text-sm font-bold
                                      text-gray-500 bg-white border border-gray-100 shadow-sm
                                      hover:shadow-md hover:border-[#D4AF37] hover:text-[#8f6a10]
                                      transition-all duration-300">
                                <svg class="w-5 h-5 text-gray-400 group-hover:text-[#D4AF37] transition-colors"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="{{ $menu['icon'] }}"></path>
                                </svg>
                                {{ $menu['label'] }}
                            </a>
                        @endforeach
                    </nav>
                </aside>

                {{-- Right Content --}}
                <div class="lg:col-span-3 space-y-20">

                    {{-- How to Order --}}
                    <section id="order" class="scroll-mt-32">
                        <div class="flex items-center gap-4 mb-12">
                            <h2 class="text-3xl font-bold text-gray-900 tracking-tight">How to Order</h2>
                            <div class="flex-grow h-px bg-gradient-to-r from-gray-200 to-transparent"></div>
                        </div>

                        <div class="relative space-y-12">
                            <div class="absolute left-5 top-2 bottom-2 w-0.5 bg-gray-100"></div>

                            @php
                                $orderSteps = [
                                    [
                                        'title' => 'Browse Products',
                                        'desc' =>
                                            'Explore our curated collections and discover items that suit your style.',
                                    ],
                                    [
                                        'title' => 'Add to Cart',
                                        'desc' =>
                                            'Choose your specific variants (size, color, or quantity) and secure them in your cart.',
                                    ],
                                    [
                                        'title' => 'Checkout',
                                        'desc' =>
                                            'Provide your delivery details. We ensure your data is encrypted and safe.',
                                    ],
                                    [
                                        'title' => 'Make Payment',
                                        'desc' =>
                                            'Finalize your purchase using our variety of secure local and international payment gateways.',
                                    ],
                                ];
                            @endphp

                            @foreach ($orderSteps as $i => $step)
                                <div class="group flex gap-8 items-start relative">
                                    <div
                                        class="flex-shrink-0 w-10 h-10 rounded-full bg-white border-2 border-[#D4AF37]/30 
                                                text-[#8f6a10] flex items-center justify-center font-bold z-10
                                                group-hover:bg-[#D4AF37] group-hover:text-white transition-all duration-300 shadow-sm">
                                        {{ $i + 1 }}
                                    </div>
                                    <div class="pt-1">
                                        <h3
                                            class="text-xl font-bold text-gray-900 mb-2 group-hover:text-[#8f6a10] transition-colors">
                                            {{ $step['title'] }}
                                        </h3>
                                        <p class="text-gray-600 leading-relaxed max-w-xl">
                                            {{ $step['desc'] }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </section>

                    {{-- Dynamic Sections --}}
                    @foreach ([
        'verify' => [
            'title' => 'How to Verify Account',
            'badge' => 'Security',
            'content' => '
                                <div class="space-y-6">
                                    <p class="text-lg">Verifying your account protects your identity and ensures smoother order processing. Once approved, your profile badge will update.</p>
                                    
                                    <div class="rounded-3xl bg-gray-50 border border-gray-100 p-8">
                                        <div class="flex items-center gap-3 mb-6">
                                            <div class="p-2 bg-white rounded-lg shadow-sm">
                                                <svg class="w-5 h-5 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                                            </div>
                                            <h4 class="text-sm font-bold text-gray-900 uppercase tracking-widest">Verification Steps</h4>
                                        </div>
                                        <ul class="space-y-4">
                                            <li class="flex gap-4 text-gray-700">
                                                <span class="text-[#D4AF37] font-bold">01</span>
                                                <span>Go to <strong class="text-gray-900">Profile Settings</strong> via the Account menu.</span>
                                            </li>
                                            <li class="flex gap-4 text-gray-700">
                                                <span class="text-[#D4AF37] font-bold">02</span>
                                                <span>Fill in all required details (Full name, phone, etc).</span>
                                            </li>
                                            <li class="flex gap-4 text-gray-700">
                                                <span class="text-[#D4AF37] font-bold">03</span>
                                                <span>Upload a clear photo of your <strong class="text-gray-900">IC / Identity Card</strong>.</span>
                                            </li>
                                            <li class="flex gap-4 text-gray-700">
                                                <span class="text-[#D4AF37] font-bold">04</span>
                                                <span>Click <strong class="text-gray-900">Submit</strong> and wait for admin review (usually 24h).</span>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="flex items-start gap-3 p-4 bg-blue-50/50 rounded-2xl border border-blue-100">
                                        <svg class="w-5 h-5 text-blue-500 mt-0.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                                        <p class="text-sm text-blue-700"><strong>Pro Tip:</strong> Ensure the ID photo is taken in natural light to avoid glare on the text.</p>
                                    </div>
                                </div>',
        ],
        'language' => [
            'title' => 'How to Switch Language',
            'badge' => 'Interface',
            'content' => '
        <div class="space-y-6">
            <p class="text-lg">
                Our website supports language translation via
                <strong class="text-[#D4AF37]">Google built-in browser translation</strong>.
                This feature is provided by your browser and does not require any additional setup.
            </p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="p-6 rounded-2xl bg-[#FAF9F6] border border-gray-100">
                    <h4 class="font-bold text-gray-900 mb-2">Desktop (Chrome / Edge)</h4>
                    <ol class="text-sm text-gray-600 space-y-2 list-decimal pl-5">
                        <li>Open the website using Google Chrome or Microsoft Edge.</li>
                        <li>Right-click anywhere on the page.</li>
                        <li>Select <strong>Translate to [your language]</strong>.</li>
                        <li>The page will automatically reload in the selected language.</li>
                    </ol>
                </div>

                <div class="p-6 rounded-2xl bg-[#FAF9F6] border border-gray-100">
                    <h4 class="font-bold text-gray-900 mb-2">Mobile (Chrome Browser)</h4>
                    <ol class="text-sm text-gray-600 space-y-2 list-decimal pl-5">
                        <li>Open the website in the Chrome browser.</li>
                        <li>Tap the three-dot menu on the top right.</li>
                        <li>Select <strong>Translate</strong>.</li>
                        <li>Choose your preferred language.</li>
                    </ol>
                </div>
            </div>

            <div class="text-sm text-gray-500 leading-relaxed">
                Note: Translation accuracy depends on Google Translate.
                Some terms or brand names may remain untranslated.
            </div>
        </div>
    ',
        ],

        'check-order' => [
            'title' => 'How to Check Order',
            'badge' => 'Orders',
            'content' => '
                                <div class="space-y-6">
                                    <p class="text-lg text-gray-600">Stay updated with your package journey from "Paid" to "Completed".</p>
                                    <div class="space-y-3">
                                        <div class="flex items-center justify-between p-4 rounded-xl bg-white border border-gray-100 shadow-sm">
                                            <div class="flex items-center gap-3">
                                                <div class="w-2 h-2 rounded-full bg-yellow-400"></div>
                                                <span class="text-sm font-semibold">Pending/Paid</span>
                                            </div>
                                            <span class="text-xs text-gray-400">Order Received</span>
                                        </div>
                                        <div class="flex items-center justify-between p-4 rounded-xl bg-white border border-gray-100 shadow-sm">
                                            <div class="flex items-center gap-3">
                                                <div class="w-2 h-2 rounded-full bg-blue-400"></div>
                                                <span class="text-sm font-semibold">Processing</span>
                                            </div>
                                            <span class="text-xs text-gray-400">Packing Items</span>
                                        </div>
                                        <div class="flex items-center justify-between p-4 rounded-xl bg-white border border-gray-100 shadow-sm">
                                            <div class="flex items-center gap-3">
                                                <div class="w-2 h-2 rounded-full bg-green-400"></div>
                                                <span class="text-sm font-semibold">Shipped</span>
                                            </div>
                                            <span class="text-xs text-gray-400">With Courier</span>
                                        </div>
                                    </div>
                                    <p class="text-sm text-gray-500 italic">Click on any order ID in your dashboard to see the full tracking history.</p>
                                </div>',
        ],
    ] as $id => $data)
                        <section id="{{ $id }}"
                            class="scroll-mt-32 p-10 rounded-[2.5rem] bg-white border border-gray-100 shadow-sm transition-all duration-500 hover:shadow-xl hover:shadow-gray-200/50">
                            <div class="flex items-center gap-3 mb-6">
                                <span
                                    class="px-3 py-1 bg-gray-100 text-gray-500 text-[10px] font-black uppercase tracking-widest rounded-lg">
                                    {{ $data['badge'] }}
                                </span>
                            </div>
                            <h2 class="text-3xl font-bold text-gray-900 mb-8">{{ $data['title'] }}</h2>
                            <div class="text-gray-600 leading-relaxed">
                                {!! $data['content'] !!}
                            </div>
                        </section>
                    @endforeach

                </div>
            </div>
        </div>
    </section>

    <style>
        html {
            scroll-behavior: smooth;
        }

        .active-guide {
            border-color: #D4AF37 !important;
            color: #8f6a10 !important;
            background-color: #fffdf7 !important;
            box-shadow: 0 10px 15px -3px rgba(212, 175, 55, 0.1) !important;
        }

        .active-guide svg {
            color: #D4AF37 !important;
        }

        /* Custom Scrollbar for a premium feel */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #FAF9F6;
        }

        ::-webkit-scrollbar-thumb {
            background: #e5e7eb;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #D4AF37;
        }
    </style>

    <script>
        const observerOptions = {
            root: null,
            rootMargin: '-20% 0px -70% 0px',
            threshold: 0
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const id = entry.target.getAttribute('id');
                    document.querySelectorAll('.guide-link').forEach(link => {
                        link.classList.toggle('active-guide', link.getAttribute('href') ===
                            `#${id}`);
                    });
                }
            });
        }, observerOptions);

        document.querySelectorAll('section[id]').forEach(section => observer.observe(section));
    </script>
</x-app-layout>
