<div>
    <div
        class="min-h-screen bg-stone-50 font-sans text-stone-800 selection:bg-green-600 selection:text-white relative overflow-x-hidden">
        <div class="fixed inset-0 z-0 pointer-events-none">
            <div class="absolute top-[-20%] left-[-10%] w-[800px] h-[800px] bg-green-600/5 rounded-full blur-[150px]">
            </div>
        </div>

        <nav class="fixed top-8 left-0 right-0 z-50 mx-auto w-[90%] max-w-5xl">
            <div
                class="flex items-center justify-between relative px-8 py-2 rounded-2xl bg-green-900/80 backdrop-blur-md border border-green-500/20 shadow-[0_8px_32px_0_rgba(0,0,0,0.36)] transition-all duration-300 hover:bg-green-900/90 hover:border-green-500/30">
                <a href="/" class="flex items-center gap-3 group">
                    <img src="{{ asset('images/logo.png') }}"
                        class="w-10 h-10 object-contain opacity-90 group-hover:opacity-100 transition-opacity">
                </a>

                <div class="hidden md:flex items-center gap-10 absolute left-1/2 -translate-x-1/2">
                    <a href="{{ url('/') }}"
                        class="text-xs font-bold uppercase tracking-[0.2em] text-white hover:text-green-400 transition-colors relative group">Home</a>
                    <a href="{{ url('/journey') }}"
                        class="text-xs font-bold uppercase tracking-[0.2em] text-white hover:text-green-400 transition-colors relative group">Journey</a>
                    <a href="#"
                        class="text-xs font-black uppercase tracking-[0.2em] text-gray-300 cursor-default relative">
                        Gallery
                        <span
                            class="absolute -bottom-1 left-1/2 w-full h-0.5 bg-green-400 -translate-x-1/2 shadow-[0_0_8px_rgba(74,222,128,0.5)]"></span>
                    </a>
                </div>

                <div class="flex items-center gap-4 text-white">
                    @auth
                        <a href="{{ url('/cart') }}"
                            class="hover:text-green-400 transition-colors transform hover:scale-110 duration-200 p-2 hover:bg-white/5 rounded-full relative">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007Z" />
                            </svg>
                            @if(auth()->check())
                                @php $cartCount = \App\Models\Cart::where('user_id', auth()->id())->count(); @endphp
                                @if($cartCount > 0)
                                    <span
                                        class="absolute -top-1 -right-1 w-4 h-4 bg-green-500 text-white text-[10px] flex items-center justify-center rounded-full font-bold">{{ $cartCount }}</span>
                                @endif
                            @elseif(count((array) session('cart')) > 0)
                                <span
                                    class="absolute -top-1 -right-1 w-4 h-4 bg-green-500 text-white text-[10px] flex items-center justify-center rounded-full font-bold">{{ count((array) session('cart')) }}</span>
                            @endif
                        </a>
                    @endauth
                    @auth
                        <a href="{{ url('/dashboard') }}" class="relative group focus:outline-none" title="Dashboard">
                            <img src="{{ Auth::user()->profile_photo_url }}"
                                class="w-8 h-8 rounded-full border-2 border-green-500/30 hover:border-green-400 transition-all">
                            <span
                                class="absolute bottom-0 right-0 w-2.5 h-2.5 bg-green-500 border-2 border-green-900 rounded-full"></span>
                        </a>

                        <form method="POST" action="{{ route('logout') }}" class="inline-flex">
                            @csrf
                            <button type="submit"
                                class="hover:text-red-500 transition-colors transform hover:scale-110 duration-200 p-2 hover:bg-white/5 rounded-full"
                                title="Logout">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                                </svg>
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}"
                            class="px-6 py-2 bg-green-600 hover:bg-green-500 text-white text-[10px] font-bold uppercase tracking-widest rounded-full transition-all duration-300 shadow-[0_4px_12px_rgba(74,222,128,0.2)] hover:shadow-[0_4px_20px_rgba(74,222,128,0.4)] transform hover:-translate-y-0.5">Login</a>
                    @endauth
                </div>
            </div>
        </nav>

        <section class="relative w-full h-screen overflow-hidden">
            <div class="absolute inset-0 overflow-hidden">
                <img src="{{ asset('images/heroimagegallery.jpg') }}"
                    class="w-full h-full object-cover object-center scale-105 animate-slow-zoom">
                <div class="absolute inset-0 bg-black/50 z-10"></div>
                <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-transparent to-black/30 z-10"></div>
            </div>
            <div class="relative z-10 h-full flex flex-col items-center justify-center text-center px-4 pt-32">
                <div class="mb-6 animate-fade-in-up">
                    <span class="text-green-500 font-black tracking-[0.4em] text-[13px] uppercase">The Gallery</span>
                </div>
                <h1
                    class="text-6xl lg:text-9xl font-black tracking-tighter text-white leading-none mb-8 drop-shadow-2xl animate-fade-in uppercase">
                    Bring The<br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-green-400 to-emerald-600">Wild
                        Home</span>
                </h1>
                <p
                    class="text-base md:text-lg text-stone-300 leading-relaxed max-w-2xl mx-auto animate-fade-in-up delay-200 font-medium">
                    Explore our curated collection of fine art wildlife photography, capturing the fleeting beauty of
                    nature's most untamed moments.
                </p>

                <a href="#gallery-filters"
                    class="absolute bottom-12 flex flex-col items-center gap-4 animate-bounce hover:opacity-100 transition-opacity opacity-80 cursor-pointer z-30 group">
                    <span
                        class="text-[10px] font-bold tracking-[0.3em] text-white uppercase group-hover:text-green-400 transition-colors">Scroll
                        to Explore</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5 text-white group-hover:text-green-400 transition-colors">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                    </svg>
                </a>
            </div>
        </section>

        <main id="gallery-filters" class="relative z-10 pt-16 pb-4">
            <div class="container mx-auto px-6">
                <div
                    class="sticky top-28 z-40 mb-16 px-8 py-6 bg-white/70 backdrop-blur-xl border border-stone-200/50 rounded-[2.5rem] shadow-2xl shadow-stone-200/40 flex flex-wrap items-center justify-between gap-8">
                    <div class="flex flex-wrap items-center gap-10">
                        <div class="flex items-center gap-3">
                            <span
                                class="text-[10px] font-bold text-stone-400 uppercase tracking-widest">Photographer:</span>
                            <select wire:model.live="photographer"
                                class="bg-transparent border-none text-xs font-bold text-stone-900 focus:ring-0 pl-0 pr-6 py-0 cursor-pointer outline-none">
                                <option value="">All Photographers</option>
                                <option value="Vinsara Senanayake">Vinsara</option>
                                <option value="Kavindu Gunawardhane">Kavindu</option>
                                <option value="Kumara Senanayake">Kumara</option>
                                <option value="Ravi Shanker">Ravi</option>
                            </select>
                        </div>

                        <div class="w-px h-4 bg-stone-200 hidden md:block"></div>

                        <div class="flex items-center gap-3">
                            <span
                                class="text-[10px] font-bold text-stone-400 uppercase tracking-widest">Category:</span>
                            <select wire:model.live="category"
                                class="bg-transparent border-none text-xs font-bold text-stone-900 focus:ring-0 pl-0 pr-6 py-0 cursor-pointer outline-none">
                                <option value="">All Collections</option>
                                <option value="Birds">Birds</option>
                                <option value="Mammals">Mammals</option>
                                <option value="Aquatics">Aquatics</option>
                                <option value="Reptiles">Reptiles</option>
                                <option value="Amphibians">Amphibians</option>
                                <option value="Butterflies">Butterflies</option>
                                <option value="Flora">Flora</option>
                            </select>
                        </div>

                        <button wire:click="clearFilters"
                            class="text-[10px] font-bold uppercase text-stone-400 hover:text-stone-600 transition-colors tracking-widest ml-4">
                            Clear Filters
                        </button>
                    </div>

                    <div class="flex items-center gap-4 ml-auto">
                        <span
                            class="text-[10px] font-bold text-stone-400 uppercase tracking-widest hidden sm:block">Sort
                            By:</span>
                        <select wire:model.live="sort"
                            class="bg-transparent border-none text-xs font-bold text-stone-900 focus:ring-0 pl-0 pr-6 py-0 cursor-pointer outline-none">
                            <option value="newest">Latest Arrivals</option>
                            <option value="price-low">Price: Low to High</option>
                            <option value="price-high">Price: High to Low</option>
                            <option value="az">A to Z</option>
                        </select>
                    </div>
                </div>

                <div id="gallery-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10 mb-24">
                    @forelse($products as $product)
                        <div
                            class="group relative aspect-[4/5] bg-stone-100 rounded-3xl overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-700 animate-reveal cursor-pointer">
                            <img src="{{ asset($product->image_url) }}" alt="{{ $product->title }}"
                                class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110">

                            <a href="{{ route('product.show', $product->id) }}"
                                class="absolute inset-0 z-10 flex flex-col justify-end p-8 bg-gradient-to-t from-stone-900/95 via-stone-900/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 pb-28">
                                <span
                                    class="text-green-400 text-[10px] font-black uppercase tracking-[0.2em] mb-2">{{ $product->category }}</span>
                                <h3 class="text-white text-2xl font-serif italic mb-1">{{ $product->title }}</h3>
                                <p class="text-stone-300 text-[10px] font-bold uppercase tracking-widest">by
                                    {{ $product->photographer ? ucwords(strtolower($product->photographer->name)) : 'Unknown' }}
                                </p>
                            </a>

                            <div
                                class="absolute bottom-0 left-0 right-0 p-8 z-20 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                                <div class="flex items-center justify-between border-t border-white/10 pt-6">
                                    <span class="text-white font-black text-sm tracking-widest"><span
                                            class="text-[9px] text-stone-400 font-bold uppercase tracking-widest mr-2">Starting
                                            Price :</span>${{ $product->price }}</span>
                                    <div class="flex items-center gap-4">
                                        <button wire:click.prevent="toggleFavorite({{ $product->id }})"
                                            class="p-2 transition-colors duration-300 group-hover:scale-110"
                                            title="Add to Favorites">
                                            @if(in_array($product->id, $userFavorites))
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                                    class="w-6 h-6 text-red-500">
                                                    <path
                                                        d="m11.645 20.91-.007-.003-.022-.012a15.247 15.247 0 0 1-.383-.218 25.18 25.18 0 0 1-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0 1 12 5.052 5.5 5.5 0 0 1 16.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 0 1-4.244 3.17 15.247 15.247 0 0 1-.383.219l-.022.012-.007.004-.003.001a.752.752 0 0 1-.704 0l-.003-.001Z" />
                                                </svg>
                                            @else
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor"
                                                    class="w-6 h-6 text-white hover:text-red-500">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                                                </svg>
                                            @endif
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full py-24 text-center text-stone-400 italic font-serif">No artifacts found in
                            this
                            collection.</div>
                    @endforelse
                </div>

                <div class="mt-12 mb-4">
                    {{ $products->links('pagination.custom') }}
                </div>
            </div>
    </div>
    </main>




    <footer class="bg-stone-950 pt-20 pb-10 text-stone-400 border-t border-white/5 relative z-10 font-sans">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 mb-20">

                <div class="flex flex-col items-center text-center space-y-4">
                    <a href="/" class="flex flex-col items-center gap-4 group">
                        <img src="{{ asset('images/logo.png') }}" alt="WildTrace Logo"
                            class="w-16 h-16 object-contain opacity-90 group-hover:opacity-100 transition-opacity">
                        <span
                            class="text-2xl font-black tracking-tighter text-white group-hover:text-green-500 transition-colors">WILDTRACE</span>
                    </a>
                    <p class="text-sm leading-relaxed text-stone-500 max-w-xs">
                        Connecting you with the untamed beauty of nature through ethical, fine-art wildlife photography.
                        Every print tells a story of survival and grace.
                    </p>
                </div>

                <div class="flex flex-col items-center">
                    <h4 class="text-white font-bold uppercase tracking-widest text-xs mb-8 text-center">Quick Links</h4>
                    <ul class="space-y-4 text-sm text-center">
                        <li><a href="/" class="hover:text-green-400 transition-colors duration-200 block">Home</a></li>
                        <li><a href="{{ url('/journey') }}"
                                class="hover:text-green-400 transition-colors duration-200 block">Journey</a></li>
                        <li><a href="{{ url('/gallery') }}"
                                class="hover:text-green-400 transition-colors duration-200 block">Gallery</a></li>
                        @auth
                            <li><a href="{{ url('/dashboard') }}"
                                    class="hover:text-green-400 transition-colors duration-200 block">Dashboard</a></li>
                        @else
                            <li><a href="{{ route('login') }}"
                                    class="hover:text-green-400 transition-colors duration-200 block">Login</a></li>
                        @endauth
                    </ul>
                </div>

                <div class="flex flex-col items-center">
                    <h4 class="text-white font-bold uppercase tracking-widest text-xs mb-8 text-center">Connect</h4>
                    <div class="flex gap-4 mb-8 justify-center">
                        <a href="https://www.instagram.com/wild_trace/" target="_blank"
                            class="w-10 h-10 rounded-full bg-stone-900 flex items-center justify-center hover:bg-green-600 hover:text-white transition-all duration-300 group">
                            <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="currentColor"
                                viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M7 2C4.24 2 2 4.24 2 7v10c0 2.76 2.24 5 5 5h10c2.76 0 5-2.24 5-5V7c0-2.76-2.24-5-5-5H7zm10 2c1.66 0 3 1.34 3 3v10c0 1.66-1.34 3-3 3H7c-1.66 0-3-1.34-3-3V7c0-1.66 1.34-3 3-3h10zM12 7c-2.76 0-5 2.24-5 5s2.24 5 5 5 5-2.24 5-5-2.24-5-5-5zm0 2c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm5.5-1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>
                        <a href="https://www.facebook.com/wildtrace2020/" target="_blank"
                            class="w-10 h-10 rounded-full bg-stone-900 flex items-center justify-center hover:bg-green-600 hover:text-white transition-all duration-300 group">
                            <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="currentColor"
                                viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>
                        <a href="https://www.youtube.com/channel/UCUe_TYghZplD2Ckv-0wplqA/videos" target="_blank"
                            class="w-10 h-10 rounded-full bg-stone-900 flex items-center justify-center hover:bg-green-600 hover:text-white transition-all duration-300 group">
                            <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="currentColor"
                                viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M19.812 5.418c.861.23 1.538.907 1.768 1.768C21.998 8.746 22 12 22 12s0 3.255-.418 4.814a2.504 2.504 0 01-1.768 1.768c-1.56.419-7.814.419-7.814.419s-6.255 0-7.814-.419a2.505 2.505 0 01-1.768-1.768C2 15.255 2 12 2 12s0-3.255.418-4.814a2.507 2.507 0 011.768-1.768C5.744 5 11.998 5 11.998 5s6.255 0 7.814.418zM15.194 12 10 15V9l5.194 3z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>
                    </div>
                </div>

            </div>

            <div class="border-t border-white/5 pt-8 pb-12 flex items-center justify-center">
                <p class="text-[10px] font-medium text-stone-600 text-center">Copyright &copy; 2026 <span
                        class="text-stone-400">WILDTRACE</span>. All Rights Reserved.</p>
            </div>
        </div>
    </footer>
    @if($showLoginModal)
        <div class="fixed inset-0 flex items-center justify-center p-4" style="z-index: 100000;">
            <div class="fixed inset-0 bg-stone-900/40 transition-opacity"
                style="backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px);" wire:click="closeLoginModal">
            </div>

            <div class="relative bg-white/95 backdrop-blur-3xl rounded-[2.5rem] shadow-[0_32px_120px_-20px_rgba(0,0,0,0.3)] w-full max-w-xl p-10 overflow-hidden animate-fade-in-up md:p-12 border border-white/20"
                style="z-index: 100001;">

                <button type="button" wire:click="closeLoginModal"
                    class="absolute top-6 right-6 p-2 rounded-full hover:bg-white transition-colors group z-50">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="w-6 h-6 text-stone-400 group-hover:text-red-500">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>

                <div class="text-center mb-10">
                    <img src="{{ asset('images/logo.png') }}"
                        class="h-20 mx-auto mb-6 object-contain hover:scale-110 transition-transform duration-500">
                    <h3 class="text-5xl font-serif italic text-stone-900 mb-2 leading-tight">Welcome Back</h3>
                    <p class="text-[10px] font-black text-stone-400 uppercase tracking-[0.3em] mt-1">Sign in to WildTrace
                    </p>
                </div>

                <form wire:submit.prevent="performLogin" class="space-y-8">
                    <x-validation-errors
                        class="mb-4 text-[10px] text-red-500 font-bold uppercase tracking-wide text-center" />

                    <div class="space-y-6">
                        <div class="space-y-2">
                            <label class="text-[11px] font-black uppercase text-stone-500 tracking-[0.1em] ml-1">Email
                                Address</label>
                            <input type="email" wire:model="loginEmail" placeholder="name@example.com"
                                class="w-full px-6 py-4 bg-white border border-stone-200 rounded-2xl focus:ring-2 focus:ring-green-600/20 focus:border-green-600 outline-none transition-all text-stone-800 text-[13px] font-medium placeholder-stone-300 shadow-sm">
                            @error('loginEmail') <span
                                class="text-red-500 text-[10px] mt-2 block font-bold uppercase tracking-wide">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <label
                                class="text-[11px] font-black uppercase text-stone-500 tracking-[0.1em] ml-1">Password</label>
                            <div class="relative">
                                <input type="{{ $showPassword ? 'text' : 'password' }}" wire:model="loginPassword"
                                    placeholder="••••••••"
                                    class="w-full px-6 py-4 bg-white border border-stone-200 rounded-2xl focus:ring-2 focus:ring-green-600/20 focus:border-green-600 outline-none transition-all text-stone-800 text-[13px] font-medium placeholder-stone-300 shadow-sm pr-12">
                                <button type="button" wire:click="$toggle('showPassword')"
                                    class="absolute right-4 top-1/2 -translate-y-1/2 text-stone-300 hover:text-stone-600 focus:outline-none transition-colors">
                                    @if($showPassword)
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                                        </svg>
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    @endif
                                </button>
                            </div>
                            @error('loginPassword') <span
                                class="text-red-500 text-[10px] mt-2 block font-bold uppercase tracking-wide">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="pt-4">
                        <button type="submit"
                            class="w-full py-5 bg-stone-900 hover:bg-stone-800 text-white text-[11px] font-black uppercase tracking-[0.3em] rounded-2xl transition-all border border-white/10 shadow-xl shadow-stone-200 active:scale-[0.98]">
                            <span>Sign In</span>
                        </button>
                    </div>
                </form>

                <div class="pt-8 border-t border-stone-100 flex items-center justify-center gap-6 mt-6">
                    <p class="text-[10px] font-bold text-stone-400 uppercase tracking-[0.2em]">Don't have an account?</p>
                    <a href="{{ route('register') }}"
                        class="text-[10px] font-bold text-green-600 hover:text-green-500 uppercase tracking-[0.2em] transition-colors underline-offset-4 hover:underline">
                        Register Now
                    </a>
                </div>
            </div>
        </div>
    @endif
</div>
</div>