<div
    class="min-h-screen bg-stone-50 font-sans text-stone-800 selection:bg-green-600 selection:text-white relative overflow-x-hidden">

    <!-- Background global -->
    <div class="fixed inset-0 z-0 pointer-events-none">
        <div class="absolute top-[-20%] right-[-10%] w-[800px] h-[800px] bg-green-600/5 rounded-full blur-[150px]">
        </div>
        <div class="absolute bottom-[-20%] left-[-10%] w-[600px] h-[600px] bg-stone-400/10 rounded-full blur-[100px]">
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
                <!-- Home -->
                <a href="{{ url('/') }}"
                    class="text-xs font-bold uppercase tracking-[0.2em] text-white hover:text-green-400 transition-colors relative group">
                    Home
                    <span
                        class="absolute -bottom-1 left-1/2 w-0 h-0.5 bg-green-400 group-hover:w-full transition-all duration-300 -translate-x-1/2"></span>
                </a>

                <!-- Journey (Active) -->
                <a href="#" class="text-xs font-black uppercase tracking-[0.2em] text-gray-300 cursor-default relative">
                    Journey
                    <span
                        class="absolute -bottom-1 left-1/2 w-full h-0.5 bg-green-400 -translate-x-1/2 shadow-[0_0_8px_rgba(74,222,128,0.5)]"></span>
                </a>

                <!-- Gallery -->
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
    <section class="relative w-full h-[90vh] lg:h-screen overflow-hidden">
        <div class="absolute inset-0 overflow-hidden">
            <img src="{{ asset('images/heroimageaboutus.jpg') }}" alt="Sri Lanka Wildlife"
                class="w-full h-full object-cover object-center scale-105 animate-slow-zoom">
            <div class="absolute inset-0 bg-stone-950/60 z-10"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-stone-950 via-transparent to-stone-950/40 z-10"></div>
        </div>

        <div class="relative z-20 h-full flex flex-col items-center justify-center text-center px-6 pt-20">
            <div class="mb-6 animate-fade-in-up">
                <span class="text-green-500 font-black tracking-[0.4em] text-[13px] uppercase">Our Story</span>
            </div>

            <h1
                class="text-7xl lg:text-9xl font-black tracking-tighter text-white leading-none mb-10 drop-shadow-2xl animate-fade-in-up delay-100 uppercase">
                Into The<br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-green-400 to-emerald-600">Wild</span>
            </h1>

            <p
                class="text-base md:text-lg text-stone-300 leading-relaxed max-w-2xl mx-auto animate-fade-in-up delay-200 font-medium">
                WildTrace began with a single shutter click in the heart of Sri Lanka. Today, we are a bunch of
                photographers dedicated to preserving the wild through art.
            </p>

            <div class="absolute bottom-12 flex flex-col items-center gap-3 animate-bounce opacity-90">
                <span class="text-[10px] font-bold tracking-[0.3em] text-white uppercase opacity-80">Scroll to
                    Explore</span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6 text-white">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 13.5L12 21m0 0l-7.5-7.5M12 21V3" />
                </svg>
            </div>
        </div>
    </section>

    <!-- MILESTONES -->
    <section class="py-20 bg-white relative">
        <div class="container mx-auto px-6 max-w-5xl">
            <div class="relative border-l-2 border-stone-200 ml-4 md:ml-1/2 space-y-16">
                @foreach($milestones as $milestone)
                    @if($loop->odd)
                        <!-- Odd Item (Left Side) -->
                        <div class="relative flex flex-col md:flex-row items-center justify-between group">
                            <div class="absolute left-[-9px] md:left-1/2 md:-translate-x-[9px] w-4 h-4 rounded-full bg-green-500 border-4 border-white shadow-lg"></div>
                            <div class="md:w-5/12 ml-8 md:ml-0 md:text-right p-6 bg-stone-50 rounded-2xl border border-stone-100 shadow-sm hover:shadow-md transition-all">
                                <span class="text-green-600 font-bold text-xl">{{ $milestone->year }}</span>
                                <h3 class="text-xl font-serif text-stone-900 mt-1">{{ $milestone->title }}</h3>
                                <p class="text-stone-500 text-sm mt-2">{{ $milestone->description }}</p>
                            </div>
                            <div class="hidden md:block w-5/12"></div>
                        </div>
                    @else
                        <!-- Even Item (Right Side) -->
                        <div class="relative flex flex-col md:flex-row items-center justify-between group">
                            <div class="absolute left-[-9px] md:left-1/2 md:-translate-x-[9px] w-4 h-4 rounded-full bg-green-500 border-4 border-white shadow-lg"></div>
                            <div class="hidden md:block w-5/12"></div>
                            <div class="md:w-5/12 ml-8 md:ml-0 p-6 bg-stone-50 rounded-2xl border border-stone-100 shadow-sm hover:shadow-md transition-all">
                                <span class="text-green-600 font-bold text-xl">{{ $milestone->year }}</span>
                                <h3 class="text-xl font-serif text-stone-900 mt-1">{{ $milestone->title }}</h3>
                                <p class="text-stone-500 text-sm mt-2">{{ $milestone->description }}</p>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </section>

    <!-- THE TEAM -->
    <section class="py-24 bg-stone-900 text-stone-300">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h3 class="text-green-500 font-black tracking-[0.4em] text-[12px] uppercase mb-4">Photographers</h3>
                <h2 class="text-4xl font-serif text-white italic mb-4">The Eyes Behind the Lens</h2>
                <p class="text-stone-500 max-w-2xl mx-auto">A diverse team of passionate visual storytellers united by a
                    love for the wild.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($photographers as $photographer)
                    <!-- Member: {{ $photographer->name }} -->
                    <div class="relative overflow-hidden rounded-[2rem] bg-stone-900 border border-white/5 shadow-2xl transition-all duration-500 hover:shadow-green-900/10 group">
                        <div class="relative h-[450px] overflow-hidden">
                            <img src="{{ asset($photographer->image) }}"
                                class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-105">
                            <div class="absolute inset-0 bg-gradient-to-t from-stone-950 via-stone-950/60 to-transparent">
                            </div>
                            <div class="absolute top-6 right-6 z-20">
                                <span class="bg-white/10 backdrop-blur-md border border-white/20 text-white text-[9px] font-black px-3 py-1.5 rounded-full uppercase tracking-widest shadow-lg">{{ $photographer->achievement }}</span>
                            </div>
                        </div>
                        <div class="absolute inset-0 flex flex-col justify-end p-8 z-10">
                            <h3 class="text-white text-2xl font-serif italic mb-1">
                                {{ ucwords(strtolower($photographer->name)) }}</h3>
                            <p class="text-green-500 text-[10px] font-black uppercase tracking-[0.2em] mb-4">{{ $photographer->profession }}</p>
                            
                            <div class="mb-3">
                                <p class="text-stone-200 text-xs italic leading-relaxed border-l-2 border-green-500/50 pl-4 py-1">
                                    "{{ $photographer->quote }}"
                                </p>
                            </div>
                            
                            <div class="mt-4 flex items-center gap-2 uppercase tracking-[0.3em] text-[9px] font-black text-stone-300">
                                <span>{{ $photographer->post }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- COMMUNITY WORK -->
    <section class="relative py-32 overflow-hidden group/impact">
        <div id="impact-slider" class="absolute inset-0 z-0">
            <div class="absolute inset-0 impact-slide opacity-100 transition-opacity duration-1000">
                <img src="{{ asset('images/communitywork2.jpg') }}"
                    class="w-full h-full object-cover scale-105 animate-slow-zoom">
            </div>
            <div
                class="absolute inset-0 bg-stone-950/80 z-10 transition-colors duration-500 group-hover/impact:bg-stone-950/70">
            </div>
            <div class="absolute inset-0 bg-gradient-to-t from-stone-950 via-stone-950/40 to-stone-950/80 z-10"></div>
        </div>
        <div class="container mx-auto px-6 relative z-20">
            <div class="max-w-4xl mx-auto text-center">
                <h3 class="text-green-500 font-black tracking-[0.4em] text-[12px] uppercase mb-4 animate-fade-in-up">
                    Community Impact</h3>
                <h2
                    class="text-4xl md:text-6xl font-serif text-white italic mb-8 animate-fade-in-up delay-100 leading-tight">
                    Empowering Locals,<br>Protecting Nature</h2>
                <p
                    class="text-stone-300 leading-relaxed mb-16 animate-fade-in-up delay-200 text-lg font-medium max-w-2xl mx-auto">
                    We believe that true conservation happens when local communities are empowered. WildTrace works
                    directly with local stakeholders to ensure the survival of our planet's ecosystems.
                </p>
                <div class="grid sm:grid-cols-2 gap-8 text-left animate-fade-in-up delay-300">
                    <div
                        class="flex items-center gap-5 p-8 bg-white/5 backdrop-blur-xl rounded-[2.5rem] border border-white/10 transition-all hover:bg-white/10 hover:border-green-500/30 group/card">
                        <span
                            class="bg-green-600 shadow-[0_0_20px_rgba(22,163,74,0.4)] text-white p-3 rounded-2xl group-hover/card:scale-110 transition-transform">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                                stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                            </svg>
                        </span>
                        <span class="text-white font-bold text-sm tracking-wide">Reforestation projects</span>
                    </div>
                    <div
                        class="flex items-center gap-5 p-8 bg-white/5 backdrop-blur-xl rounded-[2.5rem] border border-white/10 transition-all hover:bg-white/10 hover:border-green-500/30 group/card">
                        <span
                            class="bg-green-600 shadow-[0_0_20px_rgba(22,163,74,0.4)] text-white p-3 rounded-2xl group-hover/card:scale-110 transition-transform">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                                stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                            </svg>
                        </span>
                        <span class="text-white font-bold text-sm tracking-wide">Wildlife photography workshops</span>
                    </div>
                    <div
                        class="flex items-center gap-5 p-8 bg-white/5 backdrop-blur-xl rounded-[2.5rem] border border-white/10 transition-all hover:bg-white/10 hover:border-green-500/30 group/card">
                        <span
                            class="bg-green-600 shadow-[0_0_20px_rgba(22,163,74,0.4)] text-white p-3 rounded-2xl group-hover/card:scale-110 transition-transform">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                                stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                            </svg>
                        </span>
                        <span class="text-white font-bold text-sm tracking-wide">Calendar sponsorships</span>
                    </div>
                    <div
                        class="flex items-center gap-5 p-8 bg-white/5 backdrop-blur-xl rounded-[2.5rem] border border-white/10 transition-all hover:bg-white/10 hover:border-green-500/30 group/card">
                        <span
                            class="bg-green-600 shadow-[0_0_20px_rgba(22,163,74,0.4)] text-white p-3 rounded-2xl group-hover/card:scale-110 transition-transform">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                                stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                            </svg>
                        </span>
                        <span class="text-white font-bold text-sm tracking-wide">Wildlife department
                            collaboration</span>
                    </div>
                </div>
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

</div>