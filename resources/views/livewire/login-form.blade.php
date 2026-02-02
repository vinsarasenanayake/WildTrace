<div class="w-full max-w-3xl animate-fade-in-up">
    <!-- Logo area -->
    <div class="flex flex-col items-center mb-4">
        <a href="{{ route('home') }}" class="mb-2 group transition-all duration-500">
            <img src="{{ asset('images/logo.png') }}"
                class="w-16 h-16 object-contain group-hover:scale-110 transition-transform">
        </a>
        <h1 class="text-5xl font-serif italic text-stone-900 mb-0">Welcome Back</h1>
        <p class="text-[10px] font-black text-stone-400 uppercase tracking-[0.3em] mt-1">Sign in to WildTrace
        </p>
    </div>

    <!-- Professional User/Admin Toggle (Livewire version) -->
    <div class="mb-8 flex justify-center">
        <div
            class="bg-stone-100/80 p-1.5 rounded-2xl flex items-center w-full max-w-[340px] gap-2 border border-stone-200/50 shadow-sm">
            <button type="button" wire:click="toggleAdmin(false)"
                class="flex-1 py-3 px-4 rounded-xl text-[10px] font-black uppercase tracking-[0.2em] transition-all duration-300 focus:outline-none {{ !$isAdmin ? 'bg-white text-stone-900 shadow-md' : 'text-stone-400 hover:text-stone-500 hover:bg-stone-200/50' }}">
                User
            </button>
            <button type="button" wire:click="toggleAdmin(true)"
                class="flex-1 py-3 px-4 rounded-xl text-[10px] font-black uppercase tracking-[0.2em] transition-all duration-300 focus:outline-none {{ $isAdmin ? 'bg-white text-stone-900 shadow-md' : 'text-stone-400 hover:text-stone-500 hover:bg-stone-200/50' }}">
                Admin
            </button>
        </div>
    </div>

    <!-- Authentication Credentials Form Card -->
    <div
        class="bg-white/95 backdrop-blur-3xl border border-stone-200 rounded-3xl p-8 shadow-[0_32px_64px_-16px_rgba(0,0,0,0.1)]">
        <x-validation-errors class="mb-4 text-[10px] text-red-500 font-bold uppercase tracking-wide text-center" />

        @if (session('status'))
            <div class="mb-4 font-bold text-[10px] text-green-600 uppercase tracking-widest text-center">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            <!-- Dynamic Redirect based on Livewire state -->
            <input type="hidden" name="redirect" value="{{ $isAdmin ? '/admin' : '' }}">

            <!-- Two columns for Email and Password -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-[11px] font-black uppercase text-stone-500 tracking-[0.1em] ml-1">Email
                        Address</label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                        class="w-full px-5 py-4 bg-white border border-stone-200 rounded-2xl focus:ring-2 focus:ring-green-600/20 focus:border-green-600 outline-none transition-all text-stone-800 text-[13px] font-medium placeholder-stone-300 shadow-sm"
                        placeholder="name@example.com">
                </div>

                <div class="space-y-2">
                    <label
                        class="text-[11px] font-black uppercase text-stone-500 tracking-[0.1em] ml-1">Password</label>
                    <x-password-input name="password" required placeholder="••••••••" />
                </div>
            </div>

            <div class="space-y-6">
                <button type="submit"
                    class="w-full py-5 bg-stone-900 hover:bg-stone-800 text-white text-[11px] font-black uppercase tracking-[0.3em] rounded-2xl transition-all border border-white/10 shadow-xl shadow-stone-200 active:scale-[0.98]">
                    <span>{{ $isAdmin ? 'Sign In to Admin' : 'Sign In' }}</span>
                </button>

                <div class="pt-6 border-t border-stone-100/60 flex items-center justify-center gap-6">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}"
                            class="text-[10px] font-bold text-stone-400 hover:text-green-600 uppercase tracking-[0.2em] transition-colors">
                            Forgot password?
                        </a>
                    @endif

                    <span class="text-stone-200 text-xs">|</span>

                    <a href="{{ route('register') }}"
                        class="text-[10px] font-bold text-stone-400 hover:text-green-600 uppercase tracking-[0.2em] transition-colors">
                        Register Now
                    </a>
                </div>
            </div>
        </form>
    </div>

    <!-- Footer -->
    <div class="mt-6 text-center">
        <p class="text-[9px] text-stone-400 font-bold uppercase tracking-[0.4em]">WildTrace &copy; 2026</p>
    </div>
</div>