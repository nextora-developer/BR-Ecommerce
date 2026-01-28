<x-app-layout>
    <div class="bg-[#F9F7F2]">
        {{-- Banner Section: Cinematic & Deep --}}
        <section class="w-full relative z-0" data-banner-slider>
            <div class="max-w-7xl5 mx-auto px-4 sm:px-6 lg:px-8 py-8 lg:py-10 pt-5">
                <div class="relative rounded-3xl overflow-hidden shadow-[0_18px_40px_rgba(0,0,0,0.25)]">

                    @if (isset($banners) && $banners->count())
                        {{-- 用固定比例，避免不同 breakpoint 高度不一样导致裁切不同 --}}
                        <div class="relative w-full aspect-[21/10] sm:aspect-[21/9] lg:aspect-auto lg:h-[420px]">
                            {{-- 轨道 --}}
                            <div class="absolute inset-0 flex h-full transition-transform duration-700 ease-out"
                                data-banner-track>
                                @foreach ($banners as $banner)
                                    @php
                                        $url = $banner->link_url ?: route('shop.index');
                                    @endphp

                                    <a href="{{ $url }}" class="relative w-full h-full shrink-0 block group">
                                        <img src="{{ asset('storage/' . $banner->image_path) }}" alt="Banner"
                                            class="w-full h-full object-cover object-center block">
                                    </a>
                                @endforeach
                            </div>

                            {{-- 左右箭头 --}}
                            @if ($banners->count() > 1)
                                <button type="button"
                                    class="hidden sm:flex absolute left-4 top-1/2 -translate-y-1/2
                                   w-9 h-9 rounded-full bg-black/45 hover:bg-black/70
                                   text-white items-center justify-center text-sm"
                                    data-banner-prev>
                                    ‹
                                </button>

                                <button type="button"
                                    class="hidden sm:flex absolute right-4 top-1/2 -translate-y-1/2
                                   w-9 h-9 rounded-full bg-black/45 hover:bg-black/70
                                   text-white items-center justify-center text-sm"
                                    data-banner-next>
                                    ›
                                </button>

                                {{-- 小点点 --}}
                                <div class="absolute bottom-4 left-0 right-0 flex justify-center gap-2"
                                    data-banner-dots>
                                    @foreach ($banners as $index => $banner)
                                        <button type="button"
                                            class="w-2.5 h-2.5 rounded-full bg-white/40 hover:bg-white/80 transition"
                                            data-banner-dot="{{ $index }}"></button>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @else
                        {{-- 没有 banner 的时候显示一个占位背景 --}}
                        <div
                            class="w-full aspect-[21/10] sm:aspect-[21/9] lg:aspect-auto lg:h-[420px] bg-[#F5F5F7] flex items-center justify-center rounded-3xl">
                            <p class="text-gray-400 text-sm">Shop Banner coming soon</p>
                        </div>
                    @endif

                </div>
            </div>
        </section>


        {{-- Category Section: Boutique Shelf Look --}}
        <section id="categories" class="relative">
            <div class="relative mx-auto max-w-7xl5 px-4 sm:px-6 lg:px-8 sm:py-3 lg:py-4">

                @if (isset($categories) && $categories->count())
                    <div class="overflow-x-auto scrollbar-hide select-none" data-scroll-x>
                        <div class="flex gap-3 min-w-max pb-6">
                            @foreach ($categories as $category)
                                <a href="{{ route('shop.index', ['category' => $category->slug]) }}"
                                    class="group block w-[100px] sm:w-[130px] lg:w-[140px] text-center">

                                    {{-- Floating Icon Container --}}
                                    <div class="relative mx-auto w-24 h-24 sm:w-28 sm:h-28 mb-4 sm:mb-5">
                                        {{-- Back floating card --}}
                                        <div
                                            class="absolute inset-0 bg-white rounded-[1.75rem] sm:rounded-[2rem]
                               rotate-0 group-hover:rotate-12 transition-transform duration-500
                               border border-black/[0.03] shadow-sm">
                                        </div>

                                        {{-- Main card --}}
                                        <div
                                            class="relative w-full h-full rounded-[1.75rem] sm:rounded-[2rem] overflow-hidden
                               bg-white border border-black/[0.05] shadow-md
                               flex items-center justify-center
                               transition-all duration-500
                               group-hover:-translate-y-2 sm:group-hover:-translate-y-3
                               group-hover:shadow-xl group-hover:shadow-[#D4AF37]/15">
                                            @if ($category->icon)
                                                <img src="{{ asset('storage/' . $category->icon) }}"
                                                    alt="{{ $category->name }}" class="w-full h-full object-cover">
                                            @else
                                                <span
                                                    class="text-[10px] sm:text-[11px] text-black/20 font-bold uppercase tracking-tight">
                                                    No Image
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <span
                                        class="block text-[12px] sm:text-[13px] font-bold text-black/70 tracking-tight
                           transition-colors duration-300 group-hover:text-black">
                                        {{ $category->name }}
                                    </span>
                                </a>
                            @endforeach
                        </div>
                    </div>

                @endif
            </div>
        </section>


        {{-- Partials --}}
        @include('shop.partials.new-arrivals')
        @include('shop.partials.voucher-promo')
        @include('shop.partials.trust-value')

        {{-- Grand Finale CTA (Previously Refined) --}}
        @include('shop.partials.bottom-cta')
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const slider = document.querySelector('[data-scroll-x]');
            if (!slider) return;

            let isDown = false;
            let startX = 0;
            let moved = false;

            // 鼠标按下
            slider.addEventListener('mousedown', function(e) {
                isDown = true;
                moved = false;
                slider.classList.add('cursor-grabbing');

                e.preventDefault();
                startX = e.clientX;
            });

            // 鼠标抬起 / 离开
            const stopDrag = () => {
                isDown = false;
                slider.classList.remove('cursor-grabbing');
            };

            slider.addEventListener('mouseup', stopDrag);
            slider.addEventListener('mouseleave', stopDrag);

            // 鼠标移动：增量拖动（每次用上一次的位置当参考，会比较顺）
            slider.addEventListener('mousemove', function(e) {
                if (!isDown) return;

                e.preventDefault();
                const x = e.clientX;
                const delta = x - startX;

                // 灵敏度：1.2 可以自己调（1.0 更稳，1.5 更敏感）
                slider.scrollLeft -= delta * 1.2;

                startX = x; // 更新起点，下一次从这里算
                if (Math.abs(delta) > 3) moved = true;
            });

            // 拖动时不要触发里面 a 的点击
            slider.addEventListener('click', function(e) {
                if (moved) {
                    e.preventDefault();
                    e.stopPropagation();
                }
            }, true);

            // 滚轮 -> 横向滚动，稍微顺一点
            // slider.addEventListener('wheel', function(e) {
            //     if (Math.abs(e.deltaY) > Math.abs(e.deltaX)) {
            //         e.preventDefault();
            //         slider.scrollLeft += e.deltaY * 0.7;
            //     }
            // }, {
            //     passive: false
            // });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const slider = document.querySelector('[data-banner-slider]');
            if (!slider) return;

            const track = slider.querySelector('[data-banner-track]');
            const slides = Array.from(track.children);
            const prevBtn = slider.querySelector('[data-banner-prev]');
            const nextBtn = slider.querySelector('[data-banner-next]');
            const dotsWrap = slider.querySelector('[data-banner-dots]');
            const dots = dotsWrap ? Array.from(dotsWrap.querySelectorAll('[data-banner-dot]')) : [];

            let index = 0;
            let autoTimer = null;

            function goTo(i) {
                if (!slides.length) return;
                index = (i + slides.length) % slides.length;
                track.style.transform = `translateX(-${index * 100}%)`;

                // 更新底部点
                dots.forEach((dot, idx) => {
                    if (idx === index) {
                        dot.classList.add('bg-white');
                        dot.classList.remove('bg-white/40');
                    } else {
                        dot.classList.remove('bg-white');
                        dot.classList.add('bg-white/40');
                    }
                });
            }

            function next() {
                goTo(index + 1);
            }

            function prev() {
                goTo(index - 1);
            }

            // 初始
            goTo(0);

            // 按钮
            if (prevBtn) prevBtn.addEventListener('click', () => {
                prev();
                restartAuto();
            });

            if (nextBtn) nextBtn.addEventListener('click', () => {
                next();
                restartAuto();
            });

            // 点点点击
            dots.forEach((dot, idx) => {
                dot.addEventListener('click', () => {
                    goTo(idx);
                    restartAuto();
                });
            });

            // Auto slide
            function startAuto() {
                if (autoTimer) clearInterval(autoTimer);
                autoTimer = setInterval(() => {
                    next();
                }, 5000); // 5 秒一张
            }

            function restartAuto() {
                startAuto();
            }

            startAuto();

            // Touch swipe 支持（手机左右划）
            let startX = null;
            let isTouchMoving = false;

            slider.addEventListener('touchstart', (e) => {
                if (!e.touches[0]) return;
                startX = e.touches[0].clientX;
                isTouchMoving = true;
            });

            slider.addEventListener('touchmove', (e) => {
                if (!isTouchMoving || startX === null) return;
                const currentX = e.touches[0].clientX;
                const diff = currentX - startX;

                // 不做实时拖动，只是记录 swipe 方向
                // 如要实时拖动可以改这里
            });

            slider.addEventListener('touchend', (e) => {
                if (!isTouchMoving || startX === null) return;
                const endX = e.changedTouches[0].clientX;
                const diff = endX - startX;

                if (Math.abs(diff) > 50) {
                    if (diff < 0) {
                        next();
                    } else {
                        prev();
                    }
                    restartAuto();
                }

                startX = null;
                isTouchMoving = false;
            });
        });
    </script>



</x-app-layout>
