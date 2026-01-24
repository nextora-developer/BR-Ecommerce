{{-- Bottom CTA Section --}}
<section class="relative isolate bg-[#F9F7F2] overflow-hidden antialiased">

    {{-- High-End Ambient Background Composition --}}
    <div class="absolute inset-0 pointer-events-none z-0 select-none">
        {{-- Top Central Dome --}}
        <div class="absolute left-1/2 top-0 -translate-x-1/2 -translate-y-1/2">
            <div class="w-[1200px] h-[600px] rounded-full bg-[#D4AF37]/10 blur-[100px]"></div>
        </div>

        {{-- Right Side Soft Eclipse --}}
        <div class="absolute right-[-10%] top-1/2 -translate-y-1/2">
            <div class="w-[600px] h-[600px] rounded-full bg-black/[0.02] blur-[80px]"></div>
        </div>

        {{-- Texture Overlay --}}
        <div class="absolute inset-0 opacity-[0.3]"
            style="background-image: radial-gradient(circle at 1px 1px, rgba(0,0,0,.05) 1px, transparent 1px);
                   background-size: 32px 32px;">
        </div>

    </div>


    <div class="relative max-w-7xl5 mx-auto px-6 py-20 lg:py-16">
        <div
            class="relative overflow-hidden bg-white rounded-[3rem] border border-black/[0.03] shadow-[0_30px_60px_-15px_rgba(0,0,0,0.05)]">

            {{-- Internal Decorative Pattern --}}
            <div class="absolute inset-0 opacity-[0.03] pointer-events-none"
                style="background-image: url('data:image/svg+xml,%3Csvg width='20' height='20' viewBox='0 0 20 20' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%23000000' fill-opacity='1' fill-rule='evenodd'%3E%3Ccircle cx='3' cy='3' r='1'/%3E%3C/g%3E%3C/svg%3E');">
            </div>

            <div
                class="relative px-8 py-16 md:px-20 md:py-24 flex flex-col lg:flex-row items-center justify-between gap-12">

                {{-- Text Content --}}
                <div class="text-center lg:text-left max-w-2xl">
                    <h2 class="text-sm uppercase tracking-[0.4em] text-[#D4AF37] font-bold mb-6">Take the Next
                        Step</h2>
                    <p class="text-4xl md:text-5xl font-light text-black tracking-tight leading-[1.1]">
                        Ready to elevate <br class="hidden md:block" />
                        your <span class="font-serif italic text-black/70">everyday essentials?</span>
                    </p>
                </div>

                {{-- Action Buttons --}}
                <div class="flex flex-col sm:flex-row items-center gap-5 w-full lg:w-auto">
                    {{-- Primary Action --}}
                    <a href="{{ route('shop.index') }}"
                        class="group relative w-full sm:w-auto inline-flex items-center justify-center px-10 py-5 rounded-2xl
                        text-[13px] font-bold uppercase tracking-[0.2em]
                        bg-black text-white overflow-hidden transition-all duration-500 hover:shadow-2xl hover:shadow-black/20 hover:-translate-y-1">
                        <span class="relative z-10">Start Shopping</span>
                        <svg class="relative z-10 ml-3 h-4 w-4 transform transition-transform duration-500 group-hover:translate-x-2"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M14.25 7.75L18.5 12m0 0l-4.25 4.25M18.5 12H5.5" />
                        </svg>
                        {{-- Button Shine Effect --}}
                        <div
                            class="absolute inset-0 bg-gradient-to-r from-transparent via-white/10 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1000">
                        </div>
                    </a>

                    {{-- Secondary Action --}}
                    <a href="#categories"
                        class="w-full sm:w-auto inline-flex items-center justify-center px-10 py-5 rounded-2xl
                        text-[13px] font-bold uppercase tracking-[0.2em]
                        bg-transparent text-black border border-black/10
                        hover:bg-black/5 hover:border-black transition-all duration-300">
                        View Categories
                    </a>
                </div>

            </div>
        </div>
    </div>
</section>
