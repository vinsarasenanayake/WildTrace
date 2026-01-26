<div
    class="min-h-screen bg-stone-50 font-sans text-stone-800 selection:bg-green-600 selection:text-white relative overflow-x-hidden">

    <!-- Background global -->
    <div class="fixed inset-0 z-0 pointer-events-none">
        <div class="absolute top-[-20%] left-[-10%] w-[800px] h-[800px] bg-green-600/5 rounded-full blur-[150px]"></div>
    </div>

    <!-- NAVBAR -->
    <nav class="fixed top-6 left-0 right-0 z-50 mx-auto w-[95%]">
        <div
            class="flex items-center justify-between relative px-8 py-2 rounded-2xl bg-green-900/80 backdrop-blur-md border border-green-500/20 shadow-[0_8px_32px_0_rgba(0,0,0,0.36)] transition-all duration-300 hover:bg-green-900/90 hover:border-green-500/30">
            <!-- LEFT: LOGO -->
            <a href="/" class="flex items-center gap-3 group">
                <img src="{{ asset('images/logo.png') }}"
                    class="w-10 h-10 object-contain opacity-90 group-hover:opacity-100 transition-opacity">
            </a>

            <!-- CENTER: TABS -->
            <div class="hidden md:flex items-center gap-12 absolute left-1/2 -translate-x-1/2">
                <a href="{{ url('/') }}"
                    class="text-xs font-bold uppercase tracking-[0.2em] text-white hover:text-green-400 transition-colors relative group">Home</a>
                <a href="{{ url('/journey') }}"
                    class="text-xs font-bold uppercase tracking-[0.2em] text-white hover:text-green-400 transition-colors relative group">Journey</a>
                <a href="{{ url('/gallery') }}"
                    class="text-xs font-bold uppercase tracking-[0.2em] text-white hover:text-green-400 transition-colors relative group">Gallery</a>
            </div>

            <!-- RIGHT: ICONS -->
            <div class="flex items-center gap-6 text-white">
                @auth
                <a href="{{ url('/cart') }}"
                    class="hover:text-green-400 transition-colors transform hover:scale-110 duration-200 p-2 hover:bg-white/5 rounded-full relative">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007Z" />
                    </svg>
                    @if(count((array) session('cart')) > 0)
                        <span
                            class="absolute -top-1 -right-1 w-4 h-4 bg-green-500 text-white text-[10px] flex items-center justify-center rounded-full font-bold">{{ count((array) session('cart')) }}</span>
                    @endif
                </a>
                @endauth
                @auth
                    <!-- Profile Link (Dashboard) -->
                    <a href="{{ url('/dashboard') }}" class="relative group focus:outline-none" title="Dashboard">
                        <img src="{{ Auth::user()->profile_photo_url }}"
                            class="w-8 h-8 rounded-full border-2 border-green-500/30 hover:border-green-400 transition-all">
                        <!-- Online Indicator -->
                        <span class="absolute bottom-0 right-0 w-2.5 h-2.5 bg-green-500 border-2 border-green-900 rounded-full"></span>
                    </a>

                    <!-- Logout Button -->
                    <form method="POST" action="{{ route('logout') }}" class="inline-flex">
                        @csrf
                        <button type="submit" 
                            class="hover:text-red-500 transition-colors transform hover:scale-110 duration-200 p-2 hover:bg-white/5 rounded-full" 
                            title="Logout">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                            </svg>
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}"
                        class="px-6 py-2 bg-green-600 hover:bg-green-500 text-white text-[10px] font-bold uppercase tracking-widest rounded-full">Login</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Main Product Section -->
    <main class="pt-32 pb-24 relative z-10">
        <div class="container mx-auto px-6">
            <!-- Header -->
            <div class="flex flex-col items-center mb-16 text-center animate-reveal">
                <span
                    class="text-green-600 text-xs font-black uppercase tracking-[0.5em] mb-4 text-glow">{{ $product->category }}</span>
                <h1 class="text-5xl md:text-7xl lg:text-8xl font-serif italic text-stone-900 leading-none mb-6">
                    {{ $product->title }}
                </h1>
                <div
                    class="flex items-center justify-center gap-6 text-stone-500 text-[10px] font-bold uppercase tracking-[0.3em]">
                    <span>BY {{ $product->photographer ? ucwords(strtolower($product->photographer->name)) : 'Unknown' }}</span>
                    <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                    <span>AFRICA WILDERNESS</span>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start mb-24">
                <!-- Left: Image -->
                <div class="lg:col-span-8 animate-reveal" style="animation-delay: 0.1s;">
                    <div class="relative rounded-[2.5rem] overflow-hidden shadow-2xl group">
                        <img src="{{ asset($product->image_url) }}" alt="{{ $product->title }}"
                            class="w-full object-cover transition-transform duration-1000 group-hover:scale-105">
                        <div
                            class="absolute inset-0 bg-stone-900/5 group-hover:bg-transparent transition-colors duration-500">
                        </div>
                    </div>
                </div>

                <!-- Right: Purchase -->
                <div class="lg:col-span-4 space-y-8 animate-reveal" style="animation-delay: 0.2s;">
                    <div class="bg-white/80 backdrop-blur-xl border border-stone-200 rounded-[2.5rem] p-10 shadow-xl">
                        <div class="flex justify-between items-start mb-8">
                            <div>
                                <h3 class="text-xs font-black uppercase tracking-widest text-stone-400 mb-1">Museum
                                    Grade Print</h3>
                                <p class="text-4xl font-black text-stone-900">
                                    ${{ $currentPrice }}</p>
                            </div>
                        </div>

                        <div class="space-y-6">
                            <div>
                                <label
                                    class="block text-[10px] font-black uppercase tracking-widest text-stone-500 mb-3">Select
                                    Size</label>
                                <div class="grid grid-cols-2 gap-3">
                                    @foreach($product->options['frames'] as $frame)
                                                                    <button wire:click="selectSize('{{ $frame['size'] }}', {{ $frame['price'] }})"
                                                                        class="px-4 py-3 rounded-xl border text-xs font-bold transition-all shadow-md 
                                                                                                                                            {{ $selectedSize === $frame['size']
                                        ? 'border-2 border-green-500 bg-green-50 text-green-700 shadow-green-500/10'
                                        : 'border-stone-200 hover:border-green-500 bg-white text-stone-800' }}">
                                                                        {{ $frame['size'] }}
                                                                    </button>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Quantity Incrementer -->
                            <div class="pt-4 border-t border-stone-100/50 mt-6">
                                <label class="block text-[10px] font-black uppercase tracking-widest text-stone-500 mb-4">Quantity</label>
                                <div class="flex items-center gap-6">
                                    <div class="flex items-center bg-stone-50/50 border border-stone-200 rounded-2xl p-1.5 shadow-sm">
                                        <button wire:click="decrementQuantity" 
                                            {{ $quantity <= 1 ? 'disabled' : '' }}
                                            class="w-10 h-10 flex items-center justify-center rounded-xl bg-white border border-stone-100 text-stone-600 hover:text-green-600 hover:border-green-300 transition-all shadow-sm active:scale-95 disabled:opacity-30 disabled:cursor-not-allowed group/btn">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-3.5 h-3.5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12h-15" />
                                            </svg>
                                        </button>
                                        
                                        <span class="px-8 text-center text-base font-black text-stone-900 tabular-nums">{{ $quantity }}</span>
                                        
                                        <button wire:click="incrementQuantity" 
                                            class="w-10 h-10 flex items-center justify-center rounded-xl bg-white border border-stone-100 text-stone-600 hover:text-green-600 hover:border-green-300 transition-all shadow-sm active:scale-95 group/btn">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-3.5 h-3.5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="text-[10px] font-bold text-stone-400 uppercase tracking-widest">Total units</span>
                                        <span class="text-xs font-black text-stone-600">{{ $quantity }} Items</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-10 space-y-4">
                            <div class="flex gap-4">
                                <button wire:click="addToCart" wire:loading.attr="disabled" wire:target="addToCart"
                                    class="flex-1 py-5 bg-green-600 hover:bg-green-500 text-white text-xs font-black uppercase tracking-[0.2em] rounded-2xl transition-all shadow-xl shadow-green-600/20 active:scale-[0.98]">
                                    <span wire:loading.remove wire:target="addToCart">Add to Cart</span>
                                    <span wire:loading wire:target="addToCart">Adding...</span>
                                </button>

                                <button wire:click.prevent="toggleFavorite"
                                    class="p-4 rounded-2xl border border-stone-200 text-stone-400 hover:text-red-500 hover:border-red-200 transition-all group">
                                    @if($isFavorite)
                                        <!-- Filled Heart (Red) -->
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                            class="w-6 h-6 text-red-500 transition-colors">
                                            <path
                                                d="m11.645 20.91-.007-.003-.022-.012a15.247 15.247 0 0 1-.383-.218 25.18 25.18 0 0 1-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0 1 12 5.052 5.5 5.5 0 0 1 16.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 0 1-4.244 3.17 15.247 15.247 0 0 1-.383.219l-.022.012-.007.004-.003.001a.752.752 0 0 1-.704 0l-.003-.001Z" />
                                        </svg>
                                    @else
                                        <!-- Outline Heart (White/Grey) -->
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor"
                                            class="w-6 h-6 group-hover:text-red-500 transition-colors">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                                        </svg>
                                    @endif
                                </button>
                            </div>
                            <p class="text-center text-stone-400 text-[9px] font-bold uppercase tracking-widest">Free
                                Express Shipping Worldwide</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Behind the Lens -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-16 mb-24 items-center">
                <div class="lg:col-span-2 animate-reveal" style="animation-delay: 0.3s;">
                    <h2 class="text-3xl font-serif italic mb-6 text-stone-900 border-l-4 border-green-600 pl-6">Behind the Lens</h2>
                    <p class="text-stone-600 leading-relaxed text-lg font-light mb-8">{{ $product->description }}</p>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-8 py-8 border-y border-stone-200">
                        <div>
                            <span
                                class="block text-stone-400 text-[9px] font-black uppercase tracking-widest mb-1">Aperture</span>
                            <span
                                class="text-lg font-bold italic font-serif text-stone-800">{{ $product->aperture }}</span>
                        </div>
                        <div>
                            <span
                                class="block text-stone-400 text-[9px] font-black uppercase tracking-widest mb-1">Shutter</span>
                            <span
                                class="text-lg font-bold italic font-serif text-stone-800">{{ $product->shutter_speed }}</span>
                        </div>
                        <div>
                            <span
                                class="block text-stone-400 text-[9px] font-black uppercase tracking-widest mb-1">ISO</span>
                            <span
                                class="text-lg font-bold italic font-serif text-stone-800">{{ $product->iso }}</span>
                        </div>
                        <div>
                            <span
                                class="block text-stone-400 text-[9px] font-black uppercase tracking-widest mb-1">Focal</span>
                            <span
                                class="text-lg font-bold italic font-serif text-stone-800">{{ $product->focal_length }}</span>
                        </div>
                    </div>
                </div>

                <!-- Photographer Details Card (1/3 width to stay consistent with Journey size) -->
                <div class="lg:col-span-1">
                    <div class="relative overflow-hidden rounded-[2.5rem] bg-stone-950 border border-white/5 shadow-2xl shadow-green-900/10 max-w-[380px] mx-auto group">
                        <div class="relative h-[480px] overflow-hidden">
                            <img src="{{ asset($product->photographer->image) }}"
                                class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-105">
                            <div class="absolute inset-0 bg-gradient-to-t from-stone-950 via-stone-950/60 to-transparent">
                            </div>
                            <div class="absolute top-8 right-8 z-20">
                                <span class="bg-green-600/90 backdrop-blur-md text-white text-[9px] font-black px-3 py-1.5 rounded-full uppercase tracking-widest shadow-lg">{{ $product->photographer->achievement }}</span>
                            </div>
                        </div>
                        <div class="absolute inset-0 flex flex-col justify-end p-8 z-10">
                            <h3 class="text-white text-3xl font-serif italic mb-1">
                                {{ ucwords(strtolower($product->photographer->name)) }}</h3>
                            <p class="text-green-500 text-[10px] font-black uppercase tracking-[0.2em] mb-4">{{ $product->photographer->profession }}</p>
                            
                            <div class="mb-4">
                                <p class="text-stone-200 text-sm italic leading-relaxed border-l-2 border-green-500/50 pl-4 py-1">
                                    "{{ $product->photographer->quote }}"
                                </p>
                            </div>
                            
                            <div class="mt-2 flex items-center gap-2 uppercase tracking-[0.3em] text-[10px] font-black text-stone-300">
                                <span>{{ $product->photographer->post }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Related -->
            <div class="pt-24 border-t border-stone-200">
                <div class="flex justify-between items-end mb-12">
                    <h2 class="text-4xl font-serif italic text-stone-900">Similar Artifacts</h2>
                    <a href="/gallery"
                        class="text-stone-400 text-[10px] font-black uppercase tracking-widest hover:text-green-600 transition-colors">Explorer
                        Gallery</a>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @foreach($relatedArtifacts as $related)
                    <a href="{{ route('product.show', $related->id) }}" class="group cursor-pointer flex flex-col h-full">
                        <div class="relative overflow-hidden rounded-[2rem] mb-6 shadow-lg aspect-[4/3] w-full">
                            <img src="{{ asset($related->image_url) }}" alt="{{ $related->title }}" 
                                class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">
                            <div class="absolute inset-0 bg-stone-900/10 group-hover:bg-transparent transition-colors duration-500"></div>
                        </div>
                        <div class="flex justify-between items-start px-2 mt-auto">
                            <div>
                                <h3 class="text-xl font-serif italic text-stone-900 mb-1 group-hover:text-green-600 transition-colors">{{ $related->title }}</h3>
                                <p class="text-stone-400 text-[10px] font-black uppercase tracking-widest">{{ $related->category }}</p>
                            </div>
                            <span class="text-stone-900 font-black text-sm tracking-widest">${{ $related->price }}</span>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </main>

    <!-- FOOTER -->
    <footer class="bg-stone-950 pt-20 pb-10 text-stone-400 border-t border-white/5 relative z-10 font-sans">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-20">
                
                <!-- Brand Section -->
                <div class="flex flex-col items-center text-center space-y-4">
                    <a href="/" class="flex flex-col items-center gap-4 group">
                        <img src="{{ asset('images/logo.png') }}" alt="WildTrace Logo" class="w-16 h-16 object-contain opacity-90 group-hover:opacity-100 transition-opacity">
                        <span class="text-2xl font-black tracking-tighter text-white group-hover:text-green-500 transition-colors">WILDTRACE</span>
                    </a>
                    <p class="text-sm leading-relaxed text-stone-500 max-w-xs">
                        Connecting you with the untamed beauty of nature through ethical, fine-art wildlife photography. Every print tells a story of survival and grace.
                    </p>
                </div>

                <!-- Quick Links -->
                <div class="flex flex-col items-center">
                    <h4 class="text-white font-bold uppercase tracking-widest text-xs mb-8 text-center">Quick Links</h4>
                    <ul class="space-y-4 text-sm text-center">
                        <li><a href="/" class="hover:text-green-400 transition-colors duration-200 block">Home</a></li>
                        <li><a href="{{ url('/journey') }}" class="hover:text-green-400 transition-colors duration-200 block">Journey</a></li>
                        <li><a href="{{ url('/gallery') }}" class="hover:text-green-400 transition-colors duration-200 block">Gallery</a></li>
                        @auth
                            <li><a href="{{ url('/dashboard') }}" class="hover:text-green-400 transition-colors duration-200 block">Dashboard</a></li>
                        @else
                            <li><a href="{{ route('login') }}" class="hover:text-green-400 transition-colors duration-200 block">Login</a></li>
                        @endauth
                    </ul>
                </div>

                <!-- Social & Contact -->
                <div class="flex flex-col items-center">
                    <h4 class="text-white font-bold uppercase tracking-widest text-xs mb-8 text-center">Connect</h4>
                    <div class="flex gap-4 mb-8 justify-center">
                        <a href="https://www.instagram.com/wild_trace/" target="_blank" class="w-10 h-10 rounded-full bg-stone-900 flex items-center justify-center hover:bg-green-600 hover:text-white transition-all duration-300 group">
                            <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M7 2C4.24 2 2 4.24 2 7v10c0 2.76 2.24 5 5 5h10c2.76 0 5-2.24 5-5V7c0-2.76-2.24-5-5-5H7zm10 2c1.66 0 3 1.34 3 3v10c0 1.66-1.34 3-3 3H7c-1.66 0-3-1.34-3-3V7c0-1.66 1.34-3 3-3h10zM12 7c-2.76 0-5 2.24-5 5s2.24 5 5 5 5-2.24 5-5-2.24-5-5-5zm0 2c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm5.5-1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" clip-rule="evenodd"/></svg>
                        </a>
                        <a href="https://www.facebook.com/wildtrace2020/" target="_blank" class="w-10 h-10 rounded-full bg-stone-900 flex items-center justify-center hover:bg-green-600 hover:text-white transition-all duration-300 group">
                            <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" /></svg>
                        </a>
                        <a href="https://www.youtube.com/channel/UCUe_TYghZplD2Ckv-0wplqA/videos" target="_blank" class="w-10 h-10 rounded-full bg-stone-900 flex items-center justify-center hover:bg-green-600 hover:text-white transition-all duration-300 group">
                            <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M19.812 5.418c.861.23 1.538.907 1.768 1.768C21.998 8.746 22 12 22 12s0 3.255-.418 4.814a2.504 2.504 0 01-1.768 1.768c-1.56.419-7.814.419-7.814.419s-6.255 0-7.814-.419a2.505 2.505 0 01-1.768-1.768C2 15.255 2 12 2 12s0-3.255.418-4.814a2.507 2.507 0 011.768-1.768C5.744 5 11.998 5 11.998 5s6.255 0 7.814.418zM15.194 12 10 15V9l5.194 3z" clip-rule="evenodd" /></svg>
                        </a>
                    </div>
                </div>

                <!-- Newsletter -->
                <div class="space-y-6">
                    <h4 class="text-white font-bold uppercase tracking-widest text-xs">Join the Pride</h4>
                    <p class="text-xs text-stone-500">Subscribe for early access to new releases and conservation news.</p>
                    
                    <form wire:submit.prevent="subscribe" class="flex flex-col gap-3">
                        <div class="w-full">
                            <input type="email" wire:model="email" placeholder="Your email address" 
                                class="w-full h-12 bg-stone-900 border border-stone-800 rounded-lg px-4 text-sm text-white placeholder-stone-600 focus:outline-none focus:border-green-500 focus:ring-1 focus:ring-green-500 transition-all">
                            @error('email') <span class="text-red-500 text-[10px] mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        
                        <button type="submit" class="w-full h-12 bg-green-600 hover:bg-green-500 text-white rounded-lg px-4 text-xs font-bold uppercase tracking-wider transition-all duration-300 shadow-[0_4px_12px_rgba(74,222,128,0.2)] hover:shadow-[0_4px_20px_rgba(74,222,128,0.4)] flex items-center justify-center gap-2 group">
                            <span wire:loading.remove wire:target="subscribe">SUBSCRIBE</span>
                            <span wire:loading wire:target="subscribe" class="animate-pulse">SUBSCRIBING...</span>
                        </button>

                        @if (session()->has('newsletter_success'))
                            <div class="mt-2 text-green-400 text-[11px] font-bold flex items-center gap-2 animate-pulse">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3 h-3"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" /></svg>
                                {{ session('newsletter_success') }}
                            </div>
                        @endif
                    </form>
                </div>
            </div>

            <div class="border-t border-white/5 pt-8 pb-12 flex items-center justify-center">
                <p class="text-[10px] font-medium text-stone-600 text-center">Copyright &copy; 2026 <span class="text-stone-400 uppercase">WILDTRACE</span>. All Rights Reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Styled Login Modal -->
    @if($showLoginModal)
    <div class="fixed inset-0 flex items-center justify-center p-4" style="z-index: 100000;">
        <!-- Backdrop with Blur -->
        <div class="fixed inset-0 bg-stone-900/40 transition-opacity" 
             style="backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px);"
             wire:click="closeLoginModal"></div>
        
        <!-- Modal Content -->
        <div class="relative bg-stone-200 rounded-[2.5rem] shadow-2xl w-full max-w-xl p-10 overflow-hidden animate-fade-in-up md:p-12" style="z-index: 100001;">
            
            <!-- Close Button -->
            <button type="button" wire:click="closeLoginModal" class="absolute top-6 right-6 p-2 rounded-full hover:bg-white transition-colors group z-50">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6 text-stone-400 group-hover:text-red-500">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <!-- Logo & Header -->
            <div class="text-center mb-10">
                <img src="{{ asset('images/logo.png') }}" class="h-20 mx-auto mb-6 object-contain">
                <h3 class="text-5xl font-serif italic text-stone-900 mb-2 leading-tight">Welcome Back</h3>
                <p class="text-stone-400 text-[10px] font-bold uppercase tracking-[0.2em]">Sign in to WildTrace</p>
            </div>

            <form wire:submit.prevent="performLogin" class="space-y-6">
                <div>
                    <input type="email" wire:model="loginEmail" placeholder="Email Address" 
                        class="w-full bg-white border border-stone-200 rounded-xl px-6 py-4 text-stone-800 placeholder-stone-400 focus:outline-none focus:border-stone-900 focus:ring-1 focus:ring-stone-900 transition-all font-medium">
                    @error('loginEmail') <span class="text-red-500 text-xs mt-2 block font-bold">{{ $message }}</span> @enderror
                </div>
                <div class="relative">
                    <input type="{{ $showPassword ? 'text' : 'password' }}" wire:model="loginPassword" placeholder="Password" 
                        class="w-full bg-white border border-stone-200 rounded-xl px-6 py-4 text-stone-800 placeholder-stone-400 focus:outline-none focus:border-stone-900 focus:ring-1 focus:ring-stone-900 transition-all font-medium pr-12">
                    <button type="button" wire:click="$toggle('showPassword')" class="absolute right-4 top-1/2 -translate-y-1/2 text-stone-400 hover:text-stone-600 focus:outline-none">
                        @if($showPassword)
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                            </svg>
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        @endif
                    </button>
                    @error('loginPassword') <span class="text-red-500 text-xs mt-2 block font-bold">{{ $message }}</span> @enderror
                </div>

                <div class="pt-4">
                    <button type="submit" class="w-full bg-stone-900 hover:bg-stone-800 text-white font-black uppercase tracking-[0.2em] text-xs py-5 rounded-full shadow-xl transition-all hover:scale-[1.01] active:scale-[0.99]">
                        Sign In
                    </button>
                </div>
            </form>
            
            <div class="mt-8 text-center">
                <p class="text-stone-500 text-xs font-medium">Don't have an account? <a href="{{ route('register') }}" class="text-green-600 hover:text-green-500 font-bold hover:underline">Sign up</a></p>
            </div>
        </div>
    </div>
    @endif
</div>