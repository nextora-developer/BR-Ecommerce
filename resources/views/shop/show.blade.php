<x-app-layout>
    <div class="bg-[#FAF9F6] min-h-screen font-sans antialiased text-gray-900 py-6 sm:py-10">
        <div class="max-w-7xl5 mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Breadcrumb --}}
            <nav class="flex items-center space-x-2 uppercase text-sm text-gray-500 mb-6">
                <a href="{{ route('shop.index') }}" class="hover:text-[#8f6a10] transition-colors">Shop</a>
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
                <span class="text-gray-900 font-medium">{{ $product->name }}</span>
            </nav>

            {{-- 收藏状态计算 --}}
            @auth
                @php
                    $isFavorited = auth()->user()->favorites->contains('product_id', $product->id);
                @endphp
            @endauth

            {{-- Main Card --}}
            <div
                class="bg-white rounded-[2rem] border border-gray-100 shadow-[0_30px_60px_-15px_rgba(0,0,0,0.05)] overflow-hidden">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-0">

                    {{-- Left: Image Gallery (Span 7) --}}
                    <div class="lg:col-span-7 p-4 sm:p-8 lg:p-10 bg-[#FCFCFD] border-r border-gray-50">
                        <div class="sticky top-10">

                            @php
                                $gallery = [];

                                // 多图优先
                                if (isset($product->images) && count($product->images)) {
                                    foreach ($product->images as $img) {
                                        $gallery[] = asset('storage/' . $img->path);
                                    }
                                }
                                // 没有多图时，才 fallback 用单图字段
                                elseif ($product->image ?? false) {
                                    $gallery[] = asset('storage/' . $product->image);
                                }

                                if (!count($gallery)) {
                                    $gallery[] = null;
                                }
                            @endphp

                            <div data-gallery class="relative group">

                                {{-- ❤️ Favorite Button --}}
                                @auth
                                    <form
                                        action="{{ $isFavorited ? route('account.favorites.destroy', $product) : route('account.favorites.store', $product) }}"
                                        method="POST" class="absolute top-4 right-4 z-30">
                                        @csrf
                                        @if ($isFavorited)
                                            @method('DELETE')
                                        @endif

                                        <button type="submit"
                                            class="w-11 h-11 flex items-center justify-center rounded-full
                       bg-white/80 backdrop-blur-md shadow-sm border border-white
                       hover:scale-110 transition-all duration-300">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                fill="{{ $isFavorited ? '#D4AF37' : 'none' }}"
                                                stroke="{{ $isFavorited ? '#D4AF37' : '#8f6a10' }}" stroke-width="1.5"
                                                viewBox="0 0 24 24" class="h-6 w-6">
                                                <path
                                                    d="M12 21.35l-1.45-1.32C5.4 15.36
                                                                                                                   2 12.28 2 8.5 2 5.42 4.42
                                                                                                                   3 7.5 3c1.74 0 3.41.81 4.5
                                                                                                                   2.09C13.09 3.81 14.76 3 16.5
                                                                                                                   3 19.58 3 22 5.42 22 8.5c0
                                                                                                                   3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                                            </svg>
                                        </button>
                                    </form>
                                @endauth

                                {{-- 🔳 Main Gallery (Square & Centered) --}}
                                <div class="flex justify-center mb-6">
                                    <div class="relative rounded-[28px]">
                                        <div
                                            class="relative w-full max-w-[520px] aspect-square rounded-3xl overflow-hidden bg-white shadow-inner">
                                            <div class="flex h-full transition-transform duration-700 ease-out"
                                                data-gallery-track>
                                                @foreach ($gallery as $url)
                                                    <div class="w-full h-full shrink-0">
                                                        @if ($url)
                                                            <img src="{{ $url }}"
                                                                class="w-full h-full object-contain select-none"
                                                                alt="{{ $product->name }}">
                                                        @else
                                                            <div
                                                                class="w-full h-full flex flex-col items-center justify-center text-gray-300 bg-gray-50">
                                                                <svg class="w-10 h-10 mb-2 opacity-20" fill="none"
                                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path
                                                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16 m-2-2l1.586-1.586a2 2 0 012.828 0L20 14" />
                                                                </svg>
                                                                <span class="text-xs tracking-widest uppercase">
                                                                    Image Coming Soon
                                                                </span>
                                                            </div>
                                                        @endif
                                                    </div>
                                                @endforeach
                                            </div>

                                            {{-- ⬅️➡️ Navigation --}}
                                            @if (count($gallery) > 1)
                                                <button type="button"
                                                    class="hidden sm:flex absolute left-3 top-1/2 -translate-y-1/2
                                                w-9 h-9 rounded-full bg-black/45 hover:bg-black/70
                                                text-white items-center justify-center text-sm shadow
                                                backdrop-blur-sm transition"
                                                    data-gallery-prev>
                                                    ‹
                                                </button>

                                                <button type="button"
                                                    class="hidden sm:flex absolute right-3 top-1/2 -translate-y-1/2
                                                w-9 h-9 rounded-full bg-black/45 hover:bg-black/70
                                                text-white items-center justify-center text-sm shadow
                                                backdrop-blur-sm transition"
                                                    data-gallery-next>
                                                    ›
                                                </button>
                                            @endif

                                        </div>
                                    </div>
                                </div>

                                {{-- 🖼 Thumbnails --}}
                                @if (count($gallery) > 1)
                                    <div class="flex gap-4 justify-center" data-gallery-thumbs>
                                        @foreach ($gallery as $i => $url)
                                            <button type="button" data-thumb-index="{{ $i }}"
                                                class="group relative w-20 h-20 rounded-2xl overflow-hidden
                           border-2 transition-all
                           {{ $loop->first ? 'border-[#D4AF37]' : 'border-transparent' }}">
                                                @if ($url)
                                                    <img src="{{ $url }}" class="w-full h-full object-cover">
                                                @else
                                                    <div
                                                        class="w-full h-full flex items-center justify-center text-xs text-gray-400">
                                                        -
                                                    </div>
                                                @endif
                                                <div
                                                    class="absolute inset-0 bg-black/5 group-hover:bg-transparent transition">
                                                </div>
                                            </button>
                                        @endforeach
                                    </div>
                                @endif

                            </div>

                        </div>
                    </div>

                    {{-- Right: Product Details (Span 5) --}}
                    <div class="lg:col-span-5 p-6 sm:p-10 lg:p-12 flex flex-col">
                        <div class="flex-1">

                            {{-- Availability Badge --}}
                            <div
                                class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-50 text-emerald-700 text-[11px] font-bold uppercase tracking-wider border border-emerald-100 mb-6">
                                <span class="relative flex h-2 w-2">
                                    <span
                                        class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                                </span>
                                Ready Stock
                            </div>

                            {{-- Product Name --}}
                            <h1 class="text-3xl sm:text-3xl font-bold text-gray-900 tracking-tight leading-tight mb-4">
                                {{ $product->name }}
                            </h1>

                            {{-- Price Display（用你原本的变体逻辑） --}}
                            <div class="mt-2 mb-5 flex items-end gap-3">
                                <div class="text-3xl font-light text-[#8f6a10]" data-product-price>
                                    @if ($product->has_variants && $product->variants->count())
                                        @php
                                            $variantPrices = $product->variants->whereNotNull('price');
                                            $min = $variantPrices->min('price');
                                            $max = $variantPrices->max('price');
                                        @endphp

                                        @if ($min === null)
                                            <span class="font-semibold">RM 0.00</span>
                                        @elseif ($min == $max)
                                            <span class="font-semibold">RM {{ number_format($min, 2) }}</span>
                                        @else
                                            <span class="font-semibold">RM {{ number_format($min, 2) }}</span>
                                            <span class="text-gray-300 mx-1">–</span>
                                            <span class="font-semibold">RM {{ number_format($max, 2) }}</span>
                                        @endif
                                    @else
                                        <span class="font-semibold">
                                            RM {{ number_format($product->price ?? 0, 2) }}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            {{-- Feature Bar / 信任条（Dynamic from Admin Highlights） --}}
                            @php
                                $highlightMap = [
                                    'non_refundable' => [
                                        'text' => 'Non-Refundable',
                                        'icon' => 'ban',
                                        'text_class' => 'text-[#8f6a10]',
                                    ],

                                    'secure_checkout' => [
                                        'text' => 'Secure Checkout',
                                        'icon' => 'lock',
                                        'text_class' => 'text-[#8f6a10]',
                                    ],

                                    'digital_product' => [
                                        'text' => 'Digital Product',
                                        'icon' => 'chip',
                                        'text_class' => 'text-[#8f6a10]',
                                    ],

                                    'limited_deal' => [
                                        'text' => 'Limited-Time Deal',
                                        'icon' => 'flash',
                                        'text_class' => 'text-[#8f6a10]',
                                    ],

                                    'best_price' => [
                                        'text' => 'Best Price',
                                        'icon' => 'tag',
                                        'text_class' => 'text-[#8f6a10]',
                                    ],

                                    'instant_delivery' => [
                                        'text' => 'Instant Delivery',
                                        'icon' => 'bolt',
                                        'text_class' => 'text-[#8f6a10]',
                                    ],

                                    'no_shipping' => [
                                        'text' => 'No Shipping Required',
                                        'icon' => 'truck-off',
                                        'text_class' => 'text-[#8f6a10]',
                                    ],

                                    'genuine_code' => [
                                        'text' => 'Genuine Code',
                                        'icon' => 'badge',
                                        'text_class' => 'text-[#8f6a10]',
                                    ],

                                    'fraud_protection' => [
                                        'text' => 'Fraud Protection',
                                        'icon' => 'shield-check',
                                        'text_class' => 'text-[#8f6a10]',
                                    ],
                                ];
                            @endphp

                            @if (!empty($product->highlights) && is_array($product->highlights))
                                <div class="grid grid-cols-2 gap-4 mb-6">
                                    @foreach ($product->highlights as $key)
                                        @php $h = $highlightMap[$key] ?? null; @endphp
                                        @continue(!$h)

                                        <div
                                            class="flex items-center gap-3 p-3 rounded-2xl bg-[#D4AF37]/10 border border-[#D4AF37]/20">
                                            <div class="p-2 bg-white rounded-xl shadow-sm">
                                                {{-- Icons --}}
                                                @if ($h['icon'] === 'ban')
                                                    <svg class="w-4 h-4 text-[#8f6a10]"
                                                        xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M6 18 18 6M6 6l12 12" />
                                                    </svg>
                                                @elseif($h['icon'] === 'lock')
                                                    <svg class="w-4 h-4 text-[#8f6a10]"
                                                        xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.9" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                                                    </svg>
                                                @elseif($h['icon'] === 'chip')
                                                    <svg class="w-4 h-4 text-[#8f6a10]"
                                                        xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M8.25 3v1.5M4.5 8.25H3m18 0h-1.5M4.5 12H3m18 0h-1.5m-15 3.75H3m18 0h-1.5M8.25 19.5V21M12 3v1.5m0 15V21m3.75-18v1.5m0 15V21m-9-1.5h10.5a2.25 2.25 0 0 0 2.25-2.25V6.75a2.25 2.25 0 0 0-2.25-2.25H6.75A2.25 2.25 0 0 0 4.5 6.75v10.5a2.25 2.25 0 0 0 2.25 2.25Zm.75-12h9v9h-9v-9Z" />
                                                    </svg>
                                                @elseif($h['icon'] === 'flash')
                                                    <svg class="w-4 h-4 text-[#8f6a10]"
                                                        xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="m3.75 13.5 10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75Z" />
                                                    </svg>
                                                @elseif($h['icon'] === 'tag')
                                                    <svg class="w-4 h-4 text-[#8f6a10]"
                                                        xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M6 6h.008v.008H6V6Z" />
                                                    </svg>
                                                @elseif($h['icon'] === 'bolt')
                                                    <svg class="w-4 h-4 text-[#8f6a10]"
                                                        xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M13.5 21v-7.5a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349M3.75 21V9.349m0 0a3.001 3.001 0 0 0 3.75-.615A2.993 2.993 0 0 0 9.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 0 0 2.25 1.016c.896 0 1.7-.393 2.25-1.015a3.001 3.001 0 0 0 3.75.614m-16.5 0a3.004 3.004 0 0 1-.621-4.72l1.189-1.19A1.5 1.5 0 0 1 5.378 3h13.243a1.5 1.5 0 0 1 1.06.44l1.19 1.189a3 3 0 0 1-.621 4.72M6.75 18h3.75a.75.75 0 0 0 .75-.75V13.5a.75.75 0 0 0-.75-.75H6.75a.75.75 0 0 0-.75.75v3.75c0 .414.336.75.75.75Z" />
                                                    </svg>
                                                @elseif($h['icon'] === 'truck-off')
                                                    <svg class="w-4 h-4 text-[#8f6a10]"
                                                        xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 0 0-3.213-9.193 2.056 2.056 0 0 0-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 0 0-10.026 0 1.106 1.106 0 0 0-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
                                                    </svg>
                                                @elseif($h['icon'] === 'badge')
                                                    <svg class="w-4 h-4 text-[#8f6a10]"
                                                        xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z" />
                                                    </svg>
                                                @elseif($h['icon'] === 'shield-check')
                                                    <svg class="w-4 h-4 text-[#8f6a10]"
                                                        xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" />
                                                    </svg>
                                                @endif
                                            </div>

                                            <span class="text-[12px] font-medium {{ $h['text_class'] }}">
                                                {{ $h['text'] }}
                                            </span>
                                        </div>
                                    @endforeach
                                </div>
                            @endif


                            {{-- Short Description --}}
                            <div class="prose prose-sm text-gray-500 leading-relaxed mb-8 max-w-xl">
                                @if ($product->short_description)
                                    <p>{{ $product->short_description }}</p>
                                @else
                                    <p>A premium selection crafted for quality and durability.</p>
                                @endif
                            </div>

                            <hr class="border-gray-100 mb-8">

                            {{-- Add to Cart + Variant Form（完整功能版） --}}
                            <form method="POST" action="{{ route('cart.add', $product) }}" class="space-y-8">
                                @csrf

                                {{-- Variants：用你原本的 variantMap 结构 --}}
                                @if ($product->has_variants && $product->options->count())
                                    @php
                                        $variantMap = $product->variants
                                            ->map(function ($variant) {
                                                return [
                                                    'id' => $variant->id,
                                                    'price' => $variant->price,
                                                    'stock' => $variant->stock,
                                                    'options' => $variant->options ?? [],
                                                ];
                                            })
                                            ->values();
                                    @endphp

                                    <div id="variant-picker" data-variants='@json($variantMap)'
                                        class="space-y-6">
                                        @foreach ($product->options as $option)
                                            <div>
                                                <label
                                                    class="block text-[11px] font-bold uppercase tracking-widest text-gray-400 mb-3">
                                                    Select {{ $option->label ?? $option->name }}
                                                </label>
                                                <div class="flex flex-wrap gap-2.5"
                                                    data-option-key="{{ $option->name }}">
                                                    @foreach ($option->values as $value)
                                                        <button type="button"
                                                            class="variant-pill h-11 px-6 rounded-xl border border-gray-200 text-sm font-medium transition-all hover:border-[#D4AF37] hover:bg-[#FDFBF7] active:scale-95"
                                                            data-option-key="{{ $option->name }}"
                                                            data-option-value="{{ $value->value }}">
                                                            {{ $value->value }}
                                                        </button>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endforeach

                                        <p class="text-sm text-[#B28A15]" id="variant-status">
                                            Please select all options first.
                                        </p>

                                        <input type="hidden" name="variant_id" id="variant_id">
                                    </div>
                                @endif

                                {{-- Quantity & Add to Cart --}}
                                <div class="flex flex-col sm:flex-row sm:items-end gap-4">
                                    <div class="w-32">
                                        <label
                                            class="block text-[11px] font-bold uppercase tracking-widest text-gray-400 mb-3">
                                            Quantity
                                        </label>
                                        <div
                                            class="flex items-center h-14 rounded-2xl border border-gray-200 bg-white overflow-hidden shadow-sm">
                                            <button type="button"
                                                class="flex-1 h-full text-gray-400 hover:text-gray-900 transition"
                                                onclick="const input = this.parentElement.querySelector('input'); if (parseInt(input.value) > 1) input.value = parseInt(input.value) - 1;">
                                                –
                                            </button>
                                            <input type="number" name="quantity" value="1" min="1"
                                                class="w-10 text-center border-0 focus:ring-0 font-bold text-gray-900">
                                            <button type="button"
                                                class="flex-1 h-full text-gray-400 hover:text-gray-900 transition"
                                                onclick="const input = this.parentElement.querySelector('input'); input.value = parseInt(input.value || 1) + 1;">
                                                +
                                            </button>
                                        </div>
                                    </div>

                                    <div class="flex-1">
                                        <label
                                            class="block text-[11px] font-bold uppercase tracking-widest text-transparent mb-3">
                                            &nbsp;
                                        </label>
                                        <button type="submit"
                                            class="w-full h-14 bg-[#1a1a1a] text-white rounded-2xl font-bold text-sm uppercase tracking-widest hover:bg-black transition-all shadow-xl shadow-black/10 flex items-center justify-center gap-3 group">
                                            <span>Add to Cart</span>
                                            <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Tabs & Specs Section --}}
            <div class="mt-16">

                <div
                    class="bg-white rounded-[2rem] border border-gray-100 shadow-[0_18px_40px_rgba(0,0,0,0.04)] p-6 sm:p-8">

                    {{-- Tabs Header --}}
                    <div class="flex justify-center gap-6 sm:gap-12 border-b border-gray-100 mb-8">
                        <button onclick="switchTab('desc')" id="tab-btn-desc"
                            class="pb-3 sm:pb-4
               text-[11px] sm:text-sm
               font-bold uppercase tracking-widest
               text-center leading-tight
               max-w-[80px] sm:max-w-none
               border-b-2 border-[#D4AF37]
               text-gray-900">
                            Long Description
                        </button>

                        <button onclick="switchTab('info')" id="tab-btn-info"
                            class="pb-3 sm:pb-4
               text-[11px] sm:text-sm
               font-bold uppercase tracking-widest
               text-center leading-tight
               max-w-[80px] sm:max-w-none
               border-b-2 border-transparent
               text-gray-400 hover:text-gray-900 transition">
                            Additional Info
                        </button>

                        <button onclick="switchTab('review')" id="tab-btn-review"
                            class="pb-3 sm:pb-4
               text-[11px] sm:text-sm
               font-bold uppercase tracking-widest
               text-center leading-tight
               max-w-[80px] sm:max-w-none
               border-b-2 border-transparent
               text-gray-400 hover:text-gray-900 transition">
                            Reviews
                            <span class="ml-1 text-[10px] sm:text-[11px] font-black text-gray-300">
                                ({{ $reviewCount ?? 0 }})
                            </span>
                        </button>
                    </div>


                    {{-- Description Tab --}}
                    <div id="tab-desc" class="prose prose-base max-w-none text-gray-600 leading-relaxed">
                        @if ($product->description)
                            {!! $product->description !!}
                        @else
                            <p class="text-gray-500 text-sm">No description for this product yet.</p>
                        @endif
                    </div>

                    {{-- Specs Tab --}}
                    <div id="tab-info" class="hidden">
                        @if (!empty($product->specs))
                            <div class="rounded-2xl border border-gray-100 bg-white shadow-sm">

                                <div class="px-4 py-3 border-b bg-gray-50 rounded-t-2xl">
                                    <h4 class="font-semibold text-base text-gray-700">
                                        Product Specifications
                                    </h4>
                                </div>

                                <dl class="divide-y">
                                    @foreach ($product->specs as $row)
                                        <div
                                            class="grid grid-cols-[160px,1fr] gap-6 px-4 py-3 hover:bg-gray-50 transition">
                                            <dt class="text-sm font-medium text-gray-600">
                                                {{ $row['name'] ?? '-' }}
                                            </dt>
                                            <dd class="text-sm text-gray-800">
                                                {{ $row['value'] ?? '-' }}
                                            </dd>
                                        </div>
                                    @endforeach
                                </dl>

                            </div>
                        @else
                            <p class="text-center text-gray-400 py-10">
                                No additional info yet.
                            </p>
                        @endif
                    </div>

                    {{-- Review Tab --}}
                    <div id="tab-review" class="hidden">
                        <div
                            class="flex flex-col sm:flex-row sm:items-end justify-between gap-6 mb-8 pb-6 border-b border-gray-100">
                            <div>
                                <h3 class="text-lg font-bold text-gray-900">Customer Feedback</h3>
                                <div class="flex items-center gap-4 mt-2">
                                    <div class="text-4xl font-light text-gray-900 leading-none">
                                        {{ number_format($avgRating ?? 0, 1) }}
                                    </div>
                                    <div>
                                        <div class="flex items-center gap-0.5 text-[#D4AF37] text-lg leading-none">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <span
                                                    class="{{ $i <= round($avgRating ?? 0) ? '' : 'text-gray-200' }}">★</span>
                                            @endfor
                                        </div>
                                        <p class="text-xs font-medium text-gray-500 mt-1 uppercase tracking-wider">
                                            Based on {{ $reviewCount ?? 0 }}
                                            {{ Str::plural('review', $reviewCount ?? 0) }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="hidden sm:block">
                                <span
                                    class="text-[10px] inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-green-50 text-green-700 font-bold uppercase tracking-widest border border-green-100">
                                    <span class="w-1.5 h-1.5 rounded-full bg-green-500 animate-pulse"></span>
                                    100% Verified Purchases
                                </span>
                            </div>
                        </div>

                        <div class="space-y-6">
                            @forelse ($reviews as $review)
                                <div class="group relative bg-white transition-all">
                                    <div class="flex items-start gap-4">
                                        <div
                                            class="flex-shrink-0 w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-400 font-bold text-xs border border-gray-50">
                                            {{ strtoupper(substr($review->user->name ?? 'C', 0, 1)) }}
                                        </div>

                                        <div class="flex-1">
                                            <div class="flex items-center justify-between mb-1">
                                                <h4 class="text-sm font-bold text-gray-900">
                                                    {{ \Illuminate\Support\Str::limit($review->user->name ?? 'Customer', 18) }}
                                                </h4>
                                                <span class="text-xs text-gray-400">
                                                    {{ $review->created_at->format('d M Y') }}
                                                </span>
                                            </div>

                                            <div class="flex items-center gap-2 mb-3">
                                                <div class="flex items-center gap-0.5 text-[#D4AF37] text-xs">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <span>{{ $i <= $review->rating ? '★' : '☆' }}</span>
                                                    @endfor
                                                </div>
                                                <span
                                                    class="text-[9px] font-black text-[#8f6a10] uppercase tracking-tighter bg-[#FCFAF6] px-1.5 py-0.5 rounded border border-[#D4AF37]/20">
                                                    Verified
                                                </span>
                                            </div>

                                            <p class="text-sm text-gray-600 leading-relaxed">
                                                "{{ $review->comment ?: 'No comment provided.' }}"
                                            </p>
                                        </div>
                                    </div>

                                    @if (!$loop->last)
                                        <div class="mt-6 border-b border-gray-50"></div>
                                    @endif
                                </div>
                            @empty
                                <div
                                    class="py-12 text-center rounded-3xl bg-gray-50 border-2 border-dashed border-gray-100">
                                    <div class="text-gray-300 mb-3 text-4xl">★</div>
                                    <p class="text-sm text-gray-500 font-medium">No reviews yet.</p>
                                    <p class="text-xs text-gray-400 mt-1">Be the first to share your thoughts after
                                        purchase!</p>
                                </div>
                            @endforelse
                        </div>

                        @if ($reviews->hasPages())
                            <div class="mt-10 pt-6 border-t border-gray-100">
                                {{ $reviews->links() }}
                            </div>
                        @endif
                    </div>

                </div>
            </div>

            {{-- Related Products --}}
            @if ($related->count())
                <div class="mt-14">
                    <h2 class="text-lg font-semibold text-gray-900 mb-5">
                        Related Products
                    </h2>

                    <div class="grid grid-cols-2 md:grid-cols-5 gap-4 sm:gap-6">
                        @foreach ($related as $item)
                            @php
                                $itemFavorited = auth()->check()
                                    ? auth()->user()->favorites->contains('product_id', $item->id)
                                    : false;
                            @endphp

                            <div
                                class="group relative flex flex-col bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-xl hover:border-[#D4AF37]/40 transition-all duration-500 overflow-hidden">

                                {{-- Image --}}
                                <a href="{{ route('shop.show', $item->slug) }}"
                                    class="relative aspect-square overflow-hidden bg-gray-50">
                                    @if ($item->image)
                                        <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}"
                                            loading="lazy"
                                            class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700 ease-out">
                                    @else
                                        <div
                                            class="w-full h-full flex items-center justify-center bg-gray-50 text-[10px] uppercase tracking-widest text-gray-400">
                                            No Image Available
                                        </div>
                                    @endif

                                    {{-- Subtle Overlay --}}
                                    <div
                                        class="absolute inset-0 bg-black/0 group-hover:bg-black/5 transition-colors duration-500">
                                    </div>
                                </a>

                                {{-- ❤️ Favorite --}}
                                @auth
                                    <form
                                        action="{{ $itemFavorited ? route('account.favorites.destroy', $item) : route('account.favorites.store', $item) }}"
                                        method="POST" class="absolute top-3 right-3 z-10"
                                        onclick="event.stopPropagation();">
                                        @csrf
                                        @if ($itemFavorited)
                                            @method('DELETE')
                                        @endif

                                        <button type="submit"
                                            onclick="event.preventDefault(); event.stopPropagation(); this.closest('form').submit();"
                                            class="w-9 h-9 flex items-center justify-center rounded-full bg-white/90 backdrop-blur-sm text-[#8f6a10] shadow-sm hover:bg-white hover:scale-110 transition-all active:scale-95">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                fill="{{ $itemFavorited ? '#D4AF37' : 'none' }}"
                                                stroke="{{ $itemFavorited ? '#D4AF37' : 'currentColor' }}"
                                                stroke-width="1.8" viewBox="0 0 24 24" class="h-5 w-5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                                            </svg>
                                        </button>
                                    </form>
                                @endauth

                                {{-- Content --}}
                                <div class="flex-1 flex flex-col p-4">
                                    <a href="{{ route('shop.show', $item->slug) }}" class="block flex-1 group/title">
                                        <p
                                            class="text-[10px] font-bold uppercase tracking-[0.2em] text-[#D4AF37] mb-1.5">
                                            {{ $item->category->name ?? 'General' }}
                                        </p>

                                        <h3
                                            class="text-sm font-semibold text-gray-900 line-clamp-2 group-hover/title:text-[#8f6a10] transition-colors leading-snug">
                                            {{ $item->name }}
                                        </h3>
                                    </a>

                                    <div class="mt-4 flex flex-col gap-3">
                                        <p class="text-base font-bold text-gray-900">
                                            @if ($product->has_variants && $product->variants->count())
                                                @php
                                                    $prices = $product->variants->pluck('price')->filter();
                                                    $min = $prices->min();
                                                    $max = $prices->max();
                                                @endphp
                                                @if ($min == $max)
                                                    RM {{ number_format($min, 2) }}
                                                @else
                                                    <span
                                                        class="text-[10px] font-medium text-gray-400 uppercase align-middle mr-1">From</span>RM
                                                    {{ number_format($min, 2) }}
                                                @endif
                                            @else
                                                RM {{ number_format($product->price ?? 0, 2) }}
                                            @endif
                                        </p>

                                        <a href="{{ route('shop.show', $item->slug) }}"
                                            class="w-full inline-flex items-center justify-center rounded-xl bg-gray-50 border border-gray-200 py-2.5 text-xs font-bold text-gray-700 hover:bg-[#D4AF37] hover:text-white hover:border-[#D4AF37] transition-all duration-300">
                                            View Details
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif


        </div>
    </div>


    <style>
        /* Chrome / Edge / Safari */
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            // ===== Variant logic =====
            // ===== Variant 组合选择逻辑（Color / Size 分组） =====
            const picker = document.getElementById('variant-picker');
            const variantInput = document.getElementById('variant_id');
            const statusEl = document.getElementById('variant-status');
            const priceEl = document.querySelector('[data-product-price]');
            const addBtn = document.querySelector('form[action*="cart.add"] button[type="submit"]');

            // 只要有 variant block 才跑
            if (!picker || !variantInput) return;

            // ---------- 1. 拿 variants，并处理 options 结构 ----------
            const raw = JSON.parse(picker.dataset.variants || '[]');

            // 兼容：options 可能是 object，也可能是 JSON 字符串
            function normalizeOptions(opts) {
                if (!opts) return {};
                if (typeof opts === 'string') {
                    try {
                        return JSON.parse(opts);
                    } catch (e) {
                        return {};
                    }
                }
                return opts;
            }

            // 把 {"label":"Color / Size","value":"red / M"} 转成：
            // optionsMap = { Color: "red", Size: "M" }
            function buildOptionsMap(variant) {
                const optRaw = normalizeOptions(variant.options);
                const labelStr = (optRaw.label || '').trim(); // "Color / Size"
                const valueStr = (optRaw.value || '').trim(); // "red / M"

                const labelParts = labelStr.split('/').map(s => s.trim()).filter(Boolean); // ["Color","Size"]
                const valueParts = valueStr.split('/').map(s => s.trim()).filter(Boolean); // ["red","M"]

                const map = {};
                labelParts.forEach((label, index) => {
                    if (!label) return;
                    const val = valueParts[index];
                    if (val === undefined) return;
                    map[label.toLowerCase()] = val; // key 统一用小写，方便比对
                });

                return map;
            }

            const variants = raw.map(v => ({
                ...v,
                _optionsMap: buildOptionsMap(v),
            }));

            const pills = Array.from(picker.querySelectorAll('.variant-pill'));
            const selections = {}; // 例如 { Color: "red", Size: "M" }

            // 一开始先禁止下单
            if (addBtn) {
                addBtn.disabled = true;
                addBtn.classList.add('opacity-60', 'cursor-not-allowed');
            }

            // 从 DOM 拿所有 option key：["Color","Size"]
            const optionKeys = Array.from(
                    picker.querySelectorAll('[data-option-key]')
                )
                .map(el => el.getAttribute('data-option-key'))
                .filter((v, i, self) => v && self.indexOf(v) === i);

            function refreshPills() {
                pills.forEach(btn => {
                    const key = btn.dataset.optionKey;
                    const value = btn.dataset.optionValue;
                    const active = selections[key] === value;

                    btn.classList.toggle('border-[#D4AF37]', active);
                    btn.classList.toggle('text-[#8f6a10]', active);
                    btn.classList.toggle('bg-[#F9F4E5]', active);
                    btn.classList.toggle('shadow-sm', active);

                    if (!active) {
                        btn.classList.add('border-gray-300', 'text-gray-800', 'bg-white');
                    } else {
                        btn.classList.remove('border-gray-300', 'text-gray-800', 'bg-white');
                    }
                });
            }

            function findVariant() {
                if (!variants.length) return null;

                // 必须所有 option 都选好
                const allSelected = optionKeys.every(k => selections[k]);
                if (!allSelected) return null;

                return variants.find(v => {
                    const map = v._optionsMap || {};
                    // 每个 key 用小写匹配
                    return optionKeys.every(key => {
                        const want = (selections[key] || '').toLowerCase();
                        const have = (map[key.toLowerCase()] || '').toLowerCase();
                        return want === have;
                    });
                }) || null;
            }

            function updateState() {
                refreshPills();
                const variant = findVariant();

                if (!variant) {
                    variantInput.value = '';

                    if (statusEl) {
                        const selectedCount = Object.keys(selections).length;
                        const allSelected = selectedCount === optionKeys.length;

                        if (allSelected) {
                            statusEl.textContent = '此选项组合暂不可用，请换一个组合试试。';
                            statusEl.classList.remove('text-gray-500');
                            statusEl.classList.add('text-red-500');
                        } else {
                            statusEl.textContent = 'Please select all options first.';
                            statusEl.classList.remove('text-red-500');
                            statusEl.classList.add('text-gray-500');
                        }
                    }

                    if (addBtn) {
                        addBtn.disabled = true;
                        addBtn.classList.add('opacity-60', 'cursor-not-allowed');
                    }
                    return;
                }

                // ✅ 找到正确的 variant
                variantInput.value = variant.id;

                if (statusEl) {
                    const parts = optionKeys.map(key => `${key}: ${selections[key]}`);
                    statusEl.textContent = 'Selected：' + parts.join(' • ');
                    statusEl.classList.remove('text-red-500');
                    statusEl.classList.add('text-gray-500');
                }

                if (priceEl && variant.price) {
                    priceEl.textContent = 'RM ' + Number(variant.price).toFixed(2);
                }

                if (addBtn) {
                    const outOfStock = variant.stock !== undefined && Number(variant.stock) <= 0;
                    addBtn.disabled = outOfStock;
                    addBtn.classList.toggle('opacity-60', outOfStock);
                    addBtn.classList.toggle('cursor-not-allowed', outOfStock);
                }
            }

            // 点击 Color / Size 的 pill 时更新 selections
            pills.forEach(btn => {
                btn.addEventListener('click', () => {
                    const key = btn.dataset.optionKey; // "Color" 或 "Size"
                    const value = btn.dataset.optionValue; // "red" 或 "M"

                    // 再点一次同一个可以取消选中，你不想取消就把这一段 if 删掉
                    if (selections[key] === value) {
                        delete selections[key];
                    } else {
                        selections[key] = value;
                    }

                    updateState();
                });
            });


        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const gallery = document.querySelector("[data-gallery]");
            if (!gallery) return;

            const track = gallery.querySelector("[data-gallery-track]");
            if (!track) return;

            const slides = Array.from(track.children);
            const prev = gallery.querySelector("[data-gallery-prev]");
            const next = gallery.querySelector("[data-gallery-next]");
            const thumbs = Array.from(gallery.querySelectorAll("[data-thumb-index]"));

            let index = 0;

            const go = (i) => {
                if (!slides.length) return;

                index = (i + slides.length) % slides.length;
                track.style.transform = `translateX(-${index * 100}%)`;

                thumbs.forEach((t, idx) => {
                    // ✅ 先清掉所有可能冲突的 border class
                    t.classList.remove("border-[#D4AF37]", "border-gray-200", "border-transparent");

                    // ✅ 再加回当前状态
                    if (idx === index) {
                        t.classList.add("border-[#D4AF37]");
                    } else {
                        t.classList.add("border-gray-200");
                    }
                });
            };

            go(0);

            prev?.addEventListener("click", () => go(index - 1));
            next?.addEventListener("click", () => go(index + 1));

            thumbs.forEach((t) => {
                t.addEventListener("click", () => {
                    const i = parseInt(t.getAttribute("data-thumb-index"), 10);
                    go(Number.isFinite(i) ? i : 0);
                });
            });

            // Swipe on mobile
            let sx = 0;
            track.addEventListener("touchstart", (e) => (sx = e.touches[0].clientX));
            track.addEventListener("touchend", (e) => {
                const dx = e.changedTouches[0].clientX - sx;
                if (dx > 50) go(index - 1);
                if (dx < -50) go(index + 1);
            });
        });
    </script>


    <script>
        function switchTab(tab) {
            const tabs = {
                desc: document.getElementById('tab-desc'),
                info: document.getElementById('tab-info'),
                review: document.getElementById('tab-review'),
            };

            const btns = {
                desc: document.getElementById('tab-btn-desc'),
                info: document.getElementById('tab-btn-info'),
                review: document.getElementById('tab-btn-review'),
            };

            // safety
            if (!tabs.desc || !tabs.info || !tabs.review) return;

            // hide all
            Object.values(tabs).forEach(el => el.classList.add('hidden'));

            // reset btn style
            Object.values(btns).forEach(btn => {
                if (!btn) return;
                btn.classList.add('text-gray-400', 'border-transparent');
                btn.classList.remove('text-gray-700', 'border-[#D4AF37]', 'text-gray-900');
            });

            // show selected
            tabs[tab]?.classList.remove('hidden');

            // active btn
            const b = btns[tab];
            if (b) {
                b.classList.add('text-gray-900', 'border-[#D4AF37]');
                b.classList.remove('text-gray-400', 'border-transparent');
            }
        }
    </script>



</x-app-layout>
