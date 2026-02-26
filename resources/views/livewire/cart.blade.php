<div
    class="min-h-screen bg-stone-50 font-sans text-stone-800 selection:bg-green-600 selection:text-white relative overflow-x-hidden">

    <div class="fixed inset-0 z-0 pointer-events-none">
        <div class="absolute top-[-20%] left-[-10%] w-[800px] h-[800px] bg-green-600/5 rounded-full blur-[150px]"></div>
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
                <a href="{{ url('/gallery') }}"
                    class="text-xs font-bold uppercase tracking-[0.2em] text-white hover:text-green-400 transition-colors relative group">Gallery</a>
            </div>

            <div class="flex items-center gap-4 text-white">
                @auth
                    <a href="{{ url('/cart') }}"
                        class="text-white transition-colors transform scale-110 duration-200 p-2 bg-white/5 rounded-full relative border-b-2 border-green-500">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007Z" />
                        </svg>
                        @if(count($cart) > 0)
                            <span
                                class="absolute -top-1 -right-1 w-4 h-4 bg-green-500 text-white text-[10px] flex items-center justify-center rounded-full font-bold">{{ count($cart) }}</span>
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
                        class="px-6 py-2 bg-green-600 hover:bg-green-500 text-white text-[10px] font-bold uppercase tracking-widest rounded-full">Login</a>
                @endauth
            </div>
        </div>
    </nav>

    <main class="pt-32 pb-24 relative z-10 min-h-[70vh]">
        <div class="container mx-auto px-6">
            @if(session('success') && !str_contains(strtolower(session('success')), 'order placed'))
                <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show"
                    x-transition:leave="transition ease-in duration-1000" x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    class="mb-12 bg-green-500/10 border border-green-500/20 rounded-2xl p-4 text-green-600 text-sm font-bold text-center">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error') && !str_contains(strtolower(session('error')), 'payment'))
                <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 7000)" x-show="show"
                    x-transition:leave="transition ease-in duration-1000" x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    class="mb-12 bg-red-500/10 border border-red-500/20 rounded-2xl p-6 text-red-600 text-sm font-bold text-center flex items-center justify-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                        stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                    </svg>
                    {{ session('error') }}
                </div>
            @endif

            <div class="flex flex-col items-center mb-4 text-center animate-reveal">
                <span class="text-green-600 text-xs font-black uppercase tracking-[0.5em] mb-4 text-glow">YOUR
                    SELECTION</span>

                <h1 class="text-5xl md:text-7xl font-serif italic text-stone-900 leading-none mb-4">Collectors Cart</h1>

                @if((session('success') && str_contains(strtolower(session('success')), 'order placed')) || (session('error') && str_contains(strtolower(session('error')), 'payment')))
                    <div x-data="{ show: true }" x-show="show"
                        x-transition:enter="transition ease-out duration-500"
                        x-transition:enter-start="opacity-0 transform -translate-y-4 scale-95"
                        x-transition:enter-end="opacity-100 transform translate-y-0 scale-100"
                        x-transition:leave="transition ease-in duration-500"
                        x-transition:leave-start="opacity-100 transform translate-y-0 scale-100"
                        x-transition:leave-end="opacity-0 transform -translate-y-4 scale-95"
                        @class([
                            'w-full max-w-2xl mx-auto rounded-[2.5rem] p-8 mt-2 mb-4 text-center relative overflow-hidden group border backdrop-blur-2xl transition-all duration-500',
                            'bg-red-500/10 border-red-500/20 shadow-xl shadow-red-900/5' => session('error'),
                            'bg-green-500/10 border-green-500/20 shadow-xl shadow-green-900/5' => session('success')
                        ])>
                        
                        <div @class([
                            'absolute inset-0 pointer-events-none',
                            'bg-red-400/5' => session('error'),
                            'bg-green-400/5' => session('success')
                        ])></div>

                        <div class="relative z-10">
                            <h4 @class([
                                'text-[10px] font-black uppercase tracking-[0.4em] mb-3 leading-none',
                                'text-red-600' => session('error'),
                                'text-green-600' => session('success')
                            ])>WILDTRACE UPDATE</h4>
                            <p @class([
                                'text-lg md:text-xl font-serif italic leading-relaxed px-4',
                                'text-red-900' => session('error'),
                                'text-green-900' => session('success')
                            ])>
                                {{ session('success') ?? session('error') }}
                            </p>

                            <button @click="show = false" @class([
                                'mt-6 p-2 transition-colors opacity-40 hover:opacity-100',
                                'text-red-400 hover:text-red-900' => session('error'),
                                'text-green-400 hover:text-green-900' => session('success')
                            ])>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="size-4 mx-auto">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                @endif
            </div>

            @if(count($cart) > 0)
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
                    <div class="lg:col-span-8 space-y-6 animate-reveal" style="animation-delay: 0.1s;">
                        @php $total = 0 @endphp
                        @foreach($cart as $id => $details)
                            @php $total += $details['price'] * $details['quantity'] @endphp
                            <div wire:key="cart-item-{{ $id }}"
                                class="bg-white/80 backdrop-blur-xl border border-stone-200 rounded-[2rem] p-6 shadow-xl flex flex-col md:flex-row items-center gap-8 group">
                                <div class="w-full md:w-48 aspect-[4/5] rounded-2xl overflow-hidden bg-stone-100 flex-shrink-0">
                                    <img src="{{ $details['image'] }}"
                                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                </div>
                                <div class="flex-grow text-center md:text-left">
                                    <span
                                        class="text-green-600 text-[10px] font-black uppercase tracking-widest mb-1 block">Museum
                                        Grade Print</span>
                                    <h3 class="text-2xl font-serif italic text-stone-900 mb-2">{{ $details['title'] }}</h3>

                                    <div class="flex items-center justify-center md:justify-start gap-8 mt-6">
                                        <div>
                                            <p class="text-[10px] font-black text-stone-400 uppercase tracking-widest mb-1">
                                                Price</p>
                                            <p class="text-xl font-black text-stone-900">${{ $details['price'] }}</p>
                                        </div>
                                        <div class="flex flex-col items-center md:items-start">
                                            <p class="text-[10px] font-black text-stone-400 uppercase tracking-widest mb-1">
                                                Quantity</p>
                                            <div class="flex items-center gap-3">
                                                <button type="button" wire:click="decrement('{{ $id }}')"
                                                    class="w-8 h-8 rounded-full border border-stone-200 flex items-center justify-center hover:bg-stone-50 transition-colors">-</button>
                                                <span
                                                    class="text-sm font-black w-4 text-center">{{ $details['quantity'] }}</span>
                                                <button type="button" wire:click="increment('{{ $id }}')"
                                                    class="w-8 h-8 rounded-full border border-stone-200 flex items-center justify-center hover:bg-stone-50 transition-colors">+</button>
                                            </div>
                                        </div>
                                        <div>
                                            <p class="text-[10px] font-black text-stone-400 uppercase tracking-widest mb-1">
                                                Subtotal</p>
                                            <p class="text-xl font-black text-green-600">
                                                ${{ $details['price'] * $details['quantity'] }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="md:ml-auto">
                                    <button type="button" wire:click="remove('{{ $id }}')"
                                        class="p-4 text-stone-300 hover:text-red-500 transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                            stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="lg:col-span-4 animate-reveal" style="animation-delay: 0.2s;">
                        <div class="bg-stone-900 rounded-[2.5rem] p-10 shadow-2xl text-white sticky top-32">
                            <h3 class="text-2xl font-serif italic mb-8">Summary</h3>
                            <div class="space-y-4 mb-8">
                                <div class="flex justify-between text-sm">
                                    <span class="text-stone-400">Subtotal</span>
                                    <span class="font-bold">${{ $total }}</span>
                                </div>
                            </div>
                            <div class="pt-8 border-t border-white/10 mb-10 text-center md:text-left">
                                <p class="text-[10px] font-black text-stone-500 uppercase tracking-widest mb-2">Total Amount
                                </p>
                                <p class="text-5xl font-black text-white">${{ $total }}</p>
                            </div>
                            <a href="{{ route('checkout.index') }}"
                                class="flex items-center justify-center w-full py-5 bg-green-600 hover:bg-green-500 text-white text-xs font-black uppercase tracking-[0.2em] rounded-2xl transition-all shadow-xl shadow-green-600/20 active:scale-[0.98] mb-6">
                                Proceed to Checkout
                            </a>
                            <button type="button" wire:click="clearCart"
                                class="w-full py-3 bg-red-600/10 hover:bg-red-600/20 text-red-500 hover:text-red-600 border border-red-500/20 rounded-xl text-[10px] font-black uppercase tracking-[0.1em] transition-all">
                                Clear Cart
                            </button>
                        </div>
                    </div>
                </div>
            @else
                <div class="flex flex-col items-center justify-center py-4 animate-reveal">
                    <h2 class="text-2xl font-serif italic text-stone-500 mb-8">Your collection is empty.</h2>
                    <a href="{{ url('/gallery') }}"
                        class="px-8 py-3 bg-green-600 hover:bg-green-500 text-white text-xs font-black uppercase tracking-widest rounded-full transition-all shadow-lg">Start
                        Exploring</a>
                </div>
            @endif
        </div>
    </main>

    <footer class="bg-stone-950 pt-20 pb-10 text-stone-400 border-t border-white/5 relative z-10 font-sans mt-24">
        <div class="container mx-auto px-6">
            <div class="border-t border-white/5 pt-8 pb-12 flex items-center justify-center">
                <p class="text-[10px] font-medium text-stone-600 text-center">Copyright &copy; 2026 <span
                        class="text-stone-400 uppercase">WILDTRACE</span>. All Rights Reserved.</p>
            </div>
        </div>
    </footer>
</div>