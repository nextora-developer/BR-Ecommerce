<x-app-layout>
    <div class="bg-[#FAF9F6] min-h-[calc(100vh-80px)] flex items-center justify-center py-12">
        <div class="max-w-xl w-full mx-auto px-6 text-center">

            {{-- Animated Icon Container --}}
            <div class="relative mx-auto mb-8 w-20 h-20">
                {{-- Decorative pulse effect --}}
                <div class="absolute inset-0 rounded-full bg-emerald-100 animate-ping opacity-20"></div>
                <div class="relative flex items-center justify-center w-20 h-20 rounded-full bg-emerald-50 border border-emerald-100 shadow-sm">
                    <svg class="w-10 h-10 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
            </div>

            {{-- Title & Subtitle --}}
            <h1 class="text-3xl font-bold text-gray-900 mb-3 tracking-tight">
                Order Confirmed
            </h1>
            <p class="text-gray-500 text-lg leading-relaxed mb-10 max-w-sm mx-auto">
                Success! Your payment was processed and your order is being prepared.
            </p>

            {{-- Receipt Card --}}
            <div class="bg-white rounded-3xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-gray-100 p-8 text-left mb-10">
                <h2 class="text-xs uppercase tracking-widest text-gray-400 font-bold mb-6">Transaction Details</h2>
                
                <div class="space-y-4">
                    <div class="flex justify-between items-center pb-4 border-b border-gray-50">
                        <span class="text-gray-500 font-medium">Order Number</span>
                        <span class="font-mono text-gray-900 font-semibold tracking-tighter">{{ $order->order_no }}</span>
                    </div>

                    <div class="flex justify-between items-center pb-4 border-b border-gray-50">
                        <span class="text-gray-500 font-medium">Payment Method</span>
                        <div class="flex items-center gap-2">
                             <span class="inline-block w-2 h-2 rounded-full bg-emerald-500"></span>
                             <span class="font-semibold text-gray-900">{{ strtoupper($order->payment_method_name) }}</span>
                        </div>
                    </div>

                    <div class="flex justify-between items-center pt-2">
                        <span class="text-gray-900 font-bold text-lg">Amount Paid</span>
                        <span class="text-2xl font-bold text-[#8f6a10]">
                            RM {{ number_format($order->total, 2) }}
                        </span>
                    </div>
                </div>
            </div>

            {{-- Actions --}}
            <div class="flex flex-col sm:flex-row gap-3 justify-center">
                <a href="{{ route('account.orders.show', $order) }}"
                    class="group flex items-center justify-center px-8 py-4 rounded-full bg-black text-white text-sm font-bold transition-all hover:bg-gray-800 hover:shadow-lg active:scale-95">
                    Track My Order
                    <svg class="ml-2 w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </a>

                <a href="{{ route('shop.index') }}"
                    class="px-8 py-4 rounded-full border border-gray-200 bg-white text-gray-600 text-sm font-bold transition-all hover:bg-gray-50 hover:border-gray-300 active:scale-95">
                    Return to Shop
                </a>
            </div>

            {{-- Support Footer --}}
            <p class="mt-12 text-sm text-gray-400">
                Need help? <a href="https://wa.me/60123011610" class="text-gray-600 underline underline-offset-4 decoration-gray-200 hover:decoration-gray-400">Contact Support</a>
            </p>

        </div>
    </div>
</x-app-layout>