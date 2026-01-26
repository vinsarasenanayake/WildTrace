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
                        <span
                            class="absolute bottom-0 right-0 w-2.5 h-2.5 bg-green-500 border-2 border-green-900 rounded-full"></span>
                    </a>

                    <!-- Logout Button -->
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

    <!-- MAIN -->
    <main class="pt-32 pb-24 relative z-10">
        <div class="w-full px-4 md:px-8 lg:px-12">
            <div class="flex flex-col items-center mb-16 text-center animate-reveal">
                <span class="text-green-600 text-xs font-black uppercase tracking-[0.5em] mb-4 text-glow">FINAL
                    STEP</span>
                <h1 class="text-5xl md:text-7xl font-serif italic text-stone-900 leading-none mb-6">Complete Purchase
                </h1>
            </div>

            <!-- Keeping standard Form Post for robustness with existing controller logic -->
            <form action="{{ route('checkout.process') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-start w-full">

                    <!-- Form -->
                    <div class="space-y-10 animate-reveal" style="animation-delay: 0.1s;">
                        <div
                            class="bg-white/80 backdrop-blur-xl border border-stone-200 rounded-[2.5rem] p-10 shadow-xl">
                            <h3 class="text-2xl font-serif italic text-stone-900 leading-none mb-8">Shipping Details
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <label
                                        class="text-[11px] font-black uppercase text-stone-500 tracking-[0.1em] ml-1">Full
                                        Name</label>
                                    <input type="text" name="full_name" wire:model="full_name" required
                                        class="w-full bg-stone-50 border border-stone-100 rounded-2xl px-6 py-4 text-sm font-bold focus:outline-none focus:border-green-600 transition-all">
                                </div>
                                <div class="space-y-2">
                                    <label
                                        class="text-[11px] font-black uppercase text-stone-500 tracking-[0.1em] ml-1">Email
                                        Address</label>
                                    <input type="email" name="email" wire:model="email" required
                                        class="w-full bg-stone-50 border border-stone-100 rounded-2xl px-6 py-4 text-sm font-bold focus:outline-none focus:border-green-600 transition-all">
                                </div>
                                <div class="space-y-2 md:col-span-2">
                                    <label
                                        class="text-[11px] font-black uppercase text-stone-500 tracking-[0.1em] ml-1">Shipping
                                        Address</label>
                                    <input type="text" name="address" wire:model="address" required
                                        class="w-full bg-stone-50 border border-stone-100 rounded-2xl px-6 py-4 text-sm font-bold focus:outline-none focus:border-green-600 transition-all">
                                </div>
                                <div class="space-y-2">
                                    <label
                                        class="text-[11px] font-black uppercase text-stone-500 tracking-[0.1em] ml-1">City</label>
                                    <input type="text" name="city" wire:model="city" required maxlength="50"
                                        oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')"
                                        class="w-full bg-stone-50 border border-stone-100 rounded-2xl px-6 py-4 text-sm font-bold focus:outline-none focus:border-green-600 transition-all">
                                </div>
                                <div class="space-y-2">
                                    <label
                                        class="text-[11px] font-black uppercase text-stone-500 tracking-[0.1em] ml-1">Postal
                                        Code</label>
                                    <input type="text" name="postal_code" wire:model="postal_code" required
                                        maxlength="5" oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                        class="w-full bg-stone-50 border border-stone-100 rounded-2xl px-6 py-4 text-sm font-bold focus:outline-none focus:border-green-600 transition-all">
                                </div>
                                <div class="space-y-2">
                                    <label
                                        class="text-[11px] font-black uppercase text-stone-500 tracking-[0.1em] ml-1">Country</label>
                                    <div class="relative">
                                        <input type="text" value="Sri Lanka" readonly
                                            class="w-full px-6 py-4 bg-stone-100 border border-stone-200 rounded-2xl text-stone-400 text-sm font-bold cursor-not-allowed shadow-sm border-dashed">
                                        <input type="hidden" name="country" value="SL">
                                        <div class="absolute inset-y-0 right-0 flex items-center pr-6">
                                            <span
                                                class="text-[9px] font-bold uppercase tracking-widest text-stone-300">Defaulted</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="space-y-2">
                                    <label
                                        class="text-[11px] font-black uppercase text-stone-500 tracking-[0.1em] ml-1">Contact
                                        Number</label>
                                    <div
                                        class="flex rounded-2xl border border-stone-100 bg-stone-50 overflow-hidden focus-within:border-green-600 transition-all">
                                        <span
                                            class="inline-flex items-center px-4 border-r border-stone-100/50 bg-stone-100/50 text-stone-500 text-[13px] font-bold select-none">
                                            +94
                                        </span>
                                        <input type="text" name="contact_number" wire:model="contact_number" required
                                            maxlength="9" oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                            class="w-full bg-transparent border-none outline-none px-6 py-4 text-sm font-bold">
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>

                    <!-- Summary -->
                    <div class="animate-reveal" style="animation-delay: 0.2s;">
                        <div class="bg-stone-900 rounded-[2.5rem] p-10 shadow-2xl text-white sticky top-32">
                            <h3 class="text-2xl font-serif italic mb-8">Order Review</h3>
                            <div class="space-y-6 mb-10 overflow-auto max-h-[300px] pr-2 no-scrollbar">
                                @php $total = 0 @endphp
                                @foreach($cart as $id => $details)
                                    @php $total += $details['price'] * $details['quantity'] @endphp
                                    <div class="flex items-center gap-4 group">
                                        <div class="w-16 h-20 rounded-xl overflow-hidden bg-stone-800 flex-shrink-0">
                                            <img src="{{ $details['image'] }}" class="w-full h-full object-cover">
                                        </div>
                                        <div>
                                            <p class="text-white text-sm font-bold italic font-serif leading-tight">
                                                {{ $details['title'] }}
                                            </p>
                                            <p class="text-[10px] text-stone-500 font-bold uppercase tracking-widest mt-1">
                                                Qty: {{ $details['quantity'] }} • ${{ $details['price'] }}</p>
                                        </div>
                                        <p class="ml-auto text-sm font-black text-green-400">
                                            ${{ $details['price'] * $details['quantity'] }}</p>
                                    </div>
                                @endforeach
                            </div>

                            <div class="pt-8 border-t border-white/10 mb-10">
                                <div class="flex items-center justify-between text-2xl font-black">
                                    <span>Total</span>
                                    <span class="text-white">${{ $total }}</span>
                                </div>
                            </div>

                            <button type="submit"
                                class="w-full py-6 bg-green-600 hover:bg-green-500 text-white text-xs font-black uppercase tracking-[0.3em] rounded-2xl transition-all shadow-[0_0_30px_rgba(74,222,128,0.3)] active:scale-[0.98]">
                                Proceed to Payment
                            </button>
                            <p class="text-center text-xs text-stone-500 mt-4 font-medium opacity-60">You will be
                                redirected to Stripe's secure payment page to complete your purchase.</p>
                        </div>
                    </div>

                </div>
            </form>
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