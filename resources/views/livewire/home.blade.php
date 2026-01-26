<div
    class="min-h-screen bg-stone-50 font-sans text-stone-800 selection:bg-green-600 selection:text-white relative overflow-x-hidden">

    <!-- Background element to show off the glass effect -->
    <div class="absolute inset-0 z-0 pointer-events-none">
        <!-- Subtle green glow to complement the navbar -->
        <div
            class="absolute top-[-20%] left-1/2 -translate-x-1/2 w-[800px] h-[800px] bg-green-600/5 rounded-full blur-[150px]">
        </div>
    </div>

    <!-- NAVBAR -->
    <nav class="fixed top-6 left-0 right-0 z-50 mx-auto w-[95%]">
        <div
            class="flex items-center justify-between relative px-8 py-2 rounded-2xl bg-green-900/80 backdrop-blur-md border border-green-500/20 shadow-[0_8px_32px_0_rgba(0,0,0,0.36)] transition-all duration-300 hover:bg-green-900/90 hover:border-green-500/30">

            <!-- LEFT: LOGO (Smaller) -->
            <a href="/" class="flex items-center gap-3 group">
                <img src="{{ asset('images/logo.png') }}" alt="Logo"
                    class="w-10 h-10 object-contain opacity-90 group-hover:opacity-100 transition-opacity">
            </a>

            <!-- CENTER: TABS -->
            <div class="hidden md:flex items-center gap-12 absolute left-1/2 -translate-x-1/2">
                <!-- Home (Active) -->
                <a href="#" class="text-xs font-black uppercase tracking-[0.2em] text-gray-300 cursor-default relative">
                    Home
                    <span
                        class="absolute -bottom-1 left-1/2 w-full h-0.5 bg-green-400 -translate-x-1/2 shadow-[0_0_8px_rgba(74,222,128,0.5)]"></span>
                </a>

                <!-- Journey (Inactive) -->
                <a href="{{ url('/journey') }}"
                    class="text-xs font-bold uppercase tracking-[0.2em] text-white hover:text-green-400 transition-colors relative group">
                    Journey
                    <span
                        class="absolute -bottom-1 left-1/2 w-0 h-0.5 bg-green-400 group-hover:w-full transition-all duration-300 -translate-x-1/2"></span>
                </a>

                <!-- Gallery (Inactive) -->
                <a href="{{ url('/gallery') }}"
                    class="text-xs font-bold uppercase tracking-[0.2em] text-white hover:text-green-400 transition-colors relative group">
                    Gallery
                    <span
                        class="absolute -bottom-1 left-1/2 w-0 h-0.5 bg-green-400 group-hover:w-full transition-all duration-300 -translate-x-1/2"></span>
                </a>
            </div>

            <!-- RIGHT: ICONS -->
            <div class="flex items-center gap-6 text-white">
                @auth
                    <!-- Cart -->
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
                        class="px-6 py-2 bg-green-600 hover:bg-green-500 text-white text-[10px] font-bold uppercase tracking-widest rounded-full transition-all duration-300 shadow-[0_4px_12px_rgba(74,222,128,0.2)] hover:shadow-[0_4px_20px_rgba(74,222,128,0.4)] transform hover:-translate-y-0.5">Login</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- HERO SECTION -->
    <section class="relative w-full h-screen overflow-hidden">
        <!-- Background Image Slider -->
        <div id="hero-slider" class="absolute inset-0 overflow-hidden">
            <!-- Slide 1 (Active by default) -->
            <div class="absolute inset-0 transition-opacity duration-1000 ease-in-out hero-slide opacity-100">
                <img src="{{ asset('images/heroimageh1.jpg') }}" alt="Leopard"
                    class="w-full h-full object-cover object-center scale-105 animate-slow-zoom">
            </div>
            <!-- Slide 2 -->
            <div class="absolute inset-0 transition-opacity duration-1000 ease-in-out hero-slide opacity-0">
                <img src="{{ asset('images/heroimageh2.jpg') }}" alt="Elephants"
                    class="w-full h-full object-cover object-center scale-105 animate-slow-zoom">
            </div>
            <!-- Slide 3 -->
            <div class="absolute inset-0 transition-opacity duration-1000 ease-in-out hero-slide opacity-0">
                <img src="{{ asset('images/heroimageh3.jpg') }}" alt="Owl"
                    class="w-full h-full object-cover object-center scale-105 animate-slow-zoom">
            </div>

            <!-- Dark Overlay -->
            <div class="absolute inset-0 bg-black/40 z-10"></div>
            <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-transparent to-black/30 z-10"></div>
        </div>

        <!-- Content -->
        <div class="relative z-10 h-full flex flex-col items-center justify-center text-center px-4 pt-32">
            <!-- Badge -->
            <div
                class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-white text-xs font-bold uppercase tracking-widest mb-8">
                <span class="w-2 h-2 rounded-full bg-green-400 animate-pulse"></span>
                Wildlife Photography Gallery
            </div>

            <h1 class="text-7xl lg:text-9xl font-black tracking-tighter text-white leading-none mb-6 drop-shadow-2xl">
                WILD<br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-green-400 to-emerald-600">TRACE</span>
            </h1>

            <h2
                class="text-2xl lg:text-3xl text-white font-bold tracking-widest mb-4 drop-shadow-lg uppercase italic font-serif">
                “Wildlife. Untamed. Timeless.”
            </h2>

            <p class="text-lg text-stone-200 max-w-xl mx-auto leading-relaxed mb-10 drop-shadow-lg font-light">
                Fine-art wildlife photographs captured in the wild, available as prints.
            </p>

            <div class="mb-12">
                <a href="{{ url('/gallery') }}"
                    class="inline-block px-8 py-3 bg-green-600 hover:bg-green-500 text-white text-sm font-bold uppercase tracking-widest rounded-full transition-all duration-300 shadow-[0_0_20px_rgba(74,222,128,0.3)] hover:shadow-[0_0_30px_rgba(74,222,128,0.5)] transform hover:-translate-y-1">
                    View Gallery
                </a>
            </div>

            <!-- Scroll Indicator -->
            <div class="flex flex-col items-center gap-3 animate-bounce opacity-90">
                <span class="text-[10px] font-bold tracking-[0.3em] text-white uppercase opacity-80">Scroll to
                    Explore</span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6 text-white">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                </svg>
            </div>
        </div>
    </section>

    <!-- FEATURED WORK (INFINITE SCROLL) -->
    <section class="relative py-24 bg-stone-50 overflow-hidden">
        <div
            class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-[500px] bg-green-200/20 rounded-full blur-[120px] pointer-events-none">
        </div>

        <div class="relative z-10 container mx-auto px-6 mb-12 text-center">
            <h3 class="text-green-700 font-bold tracking-[0.3em] text-sm uppercase mb-3">Featured Collection</h3>
            <h2 class="text-4xl md:text-5xl font-serif text-stone-900 italic">Famous Wildlife Editions</h2>
        </div>

        <div x-data="{ 
            activeSlide: 0,
            slides: @js($featuredProducts),
            timer: null,
            next() { this.activeSlide = (this.activeSlide + 1) % this.slides.length },
            prev() { this.activeSlide = (this.activeSlide - 1 + this.slides.length) % this.slides.length },
            start() { this.timer = setInterval(() => this.next(), 3000) },
            stop() { clearInterval(this.timer) },
            init() { 
                if (this.slides.length > 0) {
                     this.start();
                }
            }
        }" @mouseenter="stop()" @mouseleave="start()" class="relative max-w-5xl mx-auto px-12">

            <div class="relative aspect-[16/9] md:aspect-[21/9] rounded-3xl overflow-hidden shadow-2xl group">
                <template x-for="(slide, index) in slides" :key="slide.id">
                    <div x-show="activeSlide === index" x-transition:enter="transition ease-out duration-700"
                        x-transition:enter-start="opacity-0 scale-105" x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-700 absolute inset-0"
                        x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                        class="absolute inset-0 w-full h-full">

                        <!-- Main Link -->
                        <a :href="'/product/' + slide.id" class="absolute inset-0 z-20"></a>

                        <img :src="slide.img" :alt="slide.title"
                            class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110">

                        <!-- Dark Overlay - Only on Hover -->
                        <div
                            class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-500 z-10">
                        </div>
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black via-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 z-10">
                        </div>

                        <!-- Content - Only on Hover -->
                        <div
                            class="absolute bottom-0 left-0 right-0 p-8 md:p-12 text-left opacity-0 group-hover:opacity-100 transition-all duration-500 transform translate-y-4 group-hover:translate-y-0 z-20 pointer-events-none">
                            <div class="flex items-center gap-2 mb-3">
                                <span class="w-8 h-[1px] bg-green-400"></span>
                                <span x-text="slide.cat"
                                    class="text-green-300 text-xs font-black uppercase tracking-widest"></span>
                            </div>
                            <h4 x-text="slide.title" class="text-3xl md:text-5xl font-serif text-white italic mb-2">
                            </h4>
                            <p class="text-stone-300 text-xs uppercase tracking-widest mb-4">
                                <span x-text="slide.loc"></span> &bull; $<span x-text="slide.price"></span>
                            </p>
                            <div class="flex items-center gap-6">
                                <span
                                    class="text-xs font-black uppercase tracking-[0.3em] text-white border-b-2 border-green-500 pb-1 hover:text-green-300 transition-all">View
                                    Print</span>
                            </div>
                        </div>
                    </div>
                </template>

                <button @click="prev()"
                    class="absolute left-6 top-1/2 -translate-y-1/2 z-30 p-4 rounded-full bg-black/20 backdrop-blur-md border border-white/10 text-white hover:bg-green-600 hover:border-green-500 transition-all opacity-0 group-hover:opacity-100 transform -translate-x-4 group-hover:translate-x-0 duration-300 hover:scale-110">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                        stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                    </svg>
                </button>
                <button @click="next()"
                    class="absolute right-6 top-1/2 -translate-y-1/2 z-30 p-4 rounded-full bg-black/20 backdrop-blur-md border border-white/10 text-white hover:bg-green-600 hover:border-green-500 transition-all opacity-0 group-hover:opacity-100 transform translate-x-4 group-hover:translate-x-0 duration-300 hover:scale-110">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                        stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                    </svg>
                </button>
            </div>

            <div class="flex justify-center gap-3 mt-8">
                <template x-for="(slide, index) in slides" :key="index">
                    <button @click="activeSlide = index"
                        :class="activeSlide === index ? 'bg-green-500 w-8' : 'bg-stone-300 w-2 hover:bg-stone-400'"
                        class="h-2 rounded-full transition-all duration-500"></button>
                </template>
            </div>
        </div>
    </section>

    <!-- TRUST & STORY -->
    <section class="relative py-16 bg-stone-900 text-stone-300 overflow-hidden text-center">
        <div class="relative container mx-auto px-6 max-w-4xl">
            <div class="flex flex-col items-center">
                <div class="max-w-3xl mb-12">
                    <div class="flex justify-center items-center gap-3 mb-6">
                        <span class="w-8 h-[1px] bg-green-500/50"></span>
                        <span class="text-green-500 font-bold tracking-[0.2em] text-[10px] uppercase">Behind the
                            Lens</span>
                        <span class="w-8 h-[1px] bg-green-500/50"></span>
                    </div>
                    <h2 class="text-4xl md:text-5xl font-serif text-white italic mb-8">Capturing the Untamed Spirit.
                    </h2>
                    <p class="text-base md:text-lg font-light leading-relaxed text-stone-400">
                        Every photograph in this gallery is captured ethically in the wild without disturbing the
                        dignity of the animal.
                        When you acquire a WildTrace print, you are supporting the preservation of these magnificent
                        creatures—<strong class="text-green-400">10% of every sale is donated directly to wildlife
                            conservation efforts.</strong>
                    </p>
                </div>

                <div class="mb-16 rounded-3xl overflow-hidden shadow-2xl relative group w-full max-w-4xl mx-auto">
                    <img src="{{ asset('images/team.jpg') }}" alt="Our Photographers"
                        class="w-full h-[450px] object-cover transition-transform duration-1000 group-hover:scale-105">
                </div>

                <div class="pt-10 border-t border-stone-800/60 w-full mb-10">
                    <p class="text-[9px] font-bold uppercase tracking-[0.3em] text-stone-500 mb-8">Our Photographers Are
                        Featured In</p>
                    <div class="flex flex-wrap justify-center items-center gap-x-12 gap-y-8">
                        <a href="https://www.nationalgeographic.com" target="_blank" rel="noopener noreferrer">
                            <img src="{{ asset('images/natgeo.png') }}" alt="National Geographic"
                                class="h-8 opacity-50 hover:opacity-100 transition-opacity">
                        </a>
                        <a href="https://www.bbcearth.com" target="_blank" rel="noopener noreferrer">
                            <img src="{{ asset('images/bbcearth.jpg') }}" alt="BBC Earth"
                                class="h-8 opacity-50 hover:opacity-100 transition-opacity">
                        </a>
                        <a href="https://www.nhm.ac.uk/wpy" target="_blank" rel="noopener noreferrer"
                            class="flex items-center gap-3 group/nhm">
                            <img src="{{ asset('images/nhmwpy.jpg') }}" alt="NHM"
                                class="h-8 opacity-50 group-hover/nhm:opacity-100 transition-opacity">
                            <span
                                class="text-[7px] text-stone-500 font-bold uppercase leading-tight tracking-widest text-left">Wildlife<br>Photographer<br>of
                                the Year</span>
                        </a>
                    </div>
                </div>

                <a href="{{ url('/journey') }}"
                    class="group inline-flex items-center gap-3 text-white font-bold uppercase tracking-widest text-[10px] border border-white/10 px-8 py-4 rounded-full hover:bg-white hover:text-black transition-all">
                    Learn More About Our Journey
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-3.5 h-3.5 group-hover:translate-x-1 transition-transform">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
                    </svg>
                </a>
            </div>
        </div>
    </section>

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
                        <!-- Instagram -->
                        <a href="https://www.instagram.com/wild_trace/" target="_blank" class="w-10 h-10 rounded-full bg-stone-900 flex items-center justify-center hover:bg-green-600 hover:text-white transition-all duration-300 group">
                            <!-- Simpler Instagram Icon Layout -->
                            <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd" d="M7 2C4.24 2 2 4.24 2 7v10c0 2.76 2.24 5 5 5h10c2.76 0 5-2.24 5-5V7c0-2.76-2.24-5-5-5H7zm10 2c1.66 0 3 1.34 3 3v10c0 1.66-1.34 3-3 3H7c-1.66 0-3-1.34-3-3V7c0-1.66 1.34-3 3-3h10zM12 7c-2.76 0-5 2.24-5 5s2.24 5 5 5 5-2.24 5-5-2.24-5-5-5zm0 2c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm5.5-1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" clip-rule="evenodd"/>
                            </svg>
                        </a>
                        <!-- Facebook -->
                        <a href="https://www.facebook.com/wildtrace2020/" target="_blank" class="w-10 h-10 rounded-full bg-stone-900 flex items-center justify-center hover:bg-green-600 hover:text-white transition-all duration-300 group">
                            <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" /></svg>
                        </a>
                        <!-- YouTube -->
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
                        
                        <!-- Updated Button Color to match Login Button (green-600 hover:green-500 shadow style) -->
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

            <!-- Copyright - Adjusted padding to be moderate -->
            <div class="border-t border-white/5 pt-8 pb-12 flex items-center justify-center">
                <p class="text-[10px] font-medium text-stone-600 text-center">Copyright &copy; 2026 <span class="text-stone-400">WILDTRACE</span>. All Rights Reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->

</div>