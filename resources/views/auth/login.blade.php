<x-guest-layout>
    <div class="w-full max-w-6xl mx-auto px-4">
        {{-- OUTER BIG CARD --}}
        <div
            class="relative rounded-[40px] bg-white/80 backdrop-blur-2xl
                    shadow-[0_40px_100px_-15px_rgba(0,0,0,0.15)] 
                    overflow-hidden lg:max-h-[min(720px,calc(100svh-100px))]">

            <div class="h-full grid grid-cols-1 lg:grid-cols-12 gap-0 items-stretch overflow-hidden rounded-[32px]">

                {{-- LEFT GOLD POSTER PANEL --}}
                <div class="lg:col-span-5 xl:col-span-5 h-full hidden lg:block">
                    <div class="relative h-full overflow-hidden">

                        <img src="{{ asset('images/user-login.png') }}"
                            onerror="this.style.display='none'; document.getElementById('luxury-placeholder').style.display='flex';"
                            alt="BRIF visual" class="absolute inset-0 w-full h-full object-cover" />

                        {{-- fallback --}}
                        <div id="luxury-placeholder"
                            class="hidden absolute inset-0 items-center justify-center
                   border-2 border-dashed border-white/30 bg-[#D4AF37]/30">
                            <span class="text-white/60 text-[11px] font-bold uppercase tracking-widest">
                                Asset: login-figures.png
                            </span>
                        </div>

                    </div>
                </div>


                {{-- RIGHT LOGIN FORM --}}
                <div class="lg:col-span-7 xl:col-span-7 h-full bg-white flex items-center px-8 py-12 sm:px-16">
                    <div class="w-full max-w-sm mx-auto">

                        <div class="mb-10 text-center lg:text-left">
                            <div class="inline-flex items-center gap-3 mb-4">
                                <img src="{{ asset('images/logo.png') }}" class="h-8 w-8 rounded-xl" alt=""
                                    onerror="this.src='https://ui-avatars.com/api/?name=B&background=D4AF37&color=fff'">
                                <span
                                    class="text-base font-black tracking-widest text-gray-400 uppercase">brif.my</span>
                            </div>
                            <h2 class="text-3xl font-black text-gray-900 tracking-tight">Welcome Back</h2>
                            <p class="text-gray-400 text-sm mt-1">Please sign in to continue to your workspace.</p>
                        </div>

                        @if (session('status'))
                            <div
                                class="mb-4 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-emerald-800 text-sm font-semibold">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('login') }}" class="space-y-5">
                            @csrf

                            <div class="group">
                                <label
                                    class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1 ml-1 group-focus-within:text-[#D4AF37] transition-colors">Email
                                    Address</label>
                                <input id="email" type="email" name="email" required autofocus
                                    class="w-full px-5 py-4 rounded-2xl bg-gray-50 border border-gray-100 
                                                  focus:bg-white focus:border-[#D4AF37] focus:ring-4 focus:ring-[#D4AF37]/5
                                                  outline-none transition-all duration-300 text-gray-900 placeholder:text-gray-300"
                                    placeholder="name@company.com" />
                            </div>

                            <div class="group">
                                <div class="flex justify-between items-center mb-1 px-1">
                                    <label
                                        class="block text-[10px] font-black text-gray-400 uppercase tracking-widest group-focus-within:text-[#D4AF37] transition-colors">Password</label>
                                    {{-- @if (Route::has('password.request'))
                                        <a href="{{ route('password.request') }}"
                                            class="text-[10px] font-bold text-[#8f6a10] hover:text-[#D4AF37]">Forgot?</a>
                                    @endif --}}
                                </div>
                                <div class="relative">
                                    <input id="password" type="password" name="password" required
                                        class="w-full px-5 py-4 rounded-2xl bg-gray-50 border border-gray-100 
                                                      focus:bg-white focus:border-[#D4AF37] focus:ring-4 focus:ring-[#D4AF37]/5
                                                      outline-none transition-all duration-300 text-gray-900 placeholder:text-gray-300"
                                        placeholder="••••••••" />
                                    <button type="button"
                                        onclick="const p=document.getElementById('password'); p.type = (p.type==='password'?'text':'password')"
                                        class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-300 hover:text-gray-600 transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <button type="submit"
                                class="w-full py-4 rounded-2xl font-black text-white tracking-[0.2em] uppercase text-[11px]
                                               bg-[#D4AF37] 
                                               shadow-[0_20px_40px_-10px_rgba(212,175,55,0.4)]
                                               hover:shadow-[0_25px_50px_-12px_rgba(212,175,55,0.5)]
                                               hover:-translate-y-1 active:translate-y-0 transition-all duration-300">
                                Sign In
                            </button>
                            <div class="mt-8">
                                <a href="{{ route('home') }}"
                                    class="group relative flex items-center justify-center w-full py-4 rounded-[20px]
                                            border border-gray-200 bg-white/70 backdrop-blur-sm
                                            text-[10px] font-black tracking-[0.3em] uppercase text-gray-600
                                            transition-all duration-500 overflow-hidden">

                                    {{-- Subtle Hover Background Glow --}}
                                    <div
                                        class="absolute inset-0 translate-y-full group-hover:translate-y-0 bg-gradient-to-t from-[#D4AF37]/5 to-transparent transition-transform duration-500">
                                    </div>

                                    <span class="relative flex items-center gap-2">
                                        {{-- Animated Arrow --}}
                                        <svg class="w-4 h-4 transform group-hover:-translate-x-1 transition-transform duration-300"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                                d="M15 19l-7-7 7-7" />
                                        </svg>

                                        Back to Shop
                                    </span>
                                </a>
                            </div>
                        </form>



                        @if (Route::has('register'))
                            <p class="mt-10 text-center text-sm text-gray-400 font-medium">
                                Don't have an account?
                                <a href="{{ route('register') }}"
                                    class="text-[#D4AF37] font-black hover:underline decoration-2 underline-offset-4 transition-all">
                                    Sign up
                                </a>
                            </p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
