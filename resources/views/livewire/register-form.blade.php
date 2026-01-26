<div class="w-full max-w-3xl animate-fade-in-up">
    <!-- Logo area -->
    <div class="flex flex-col items-center mb-8">
        <a href="{{ route('home') }}" class="mb-2 group transition-all duration-500">
            <img src="{{ asset('images/logo.png') }}"
                class="w-16 h-16 object-contain group-hover:scale-110 transition-transform">
        </a>
        <h1 class="text-5xl font-serif italic text-stone-900 mb-0">Join WildTrace</h1>
        <p class="text-[10px] font-black text-stone-400 uppercase tracking-[0.3em] mt-1">Create your account
        </p>
    </div>

    <!-- Form Card -->
    <div
        class="bg-white/95 backdrop-blur-3xl border border-stone-200 rounded-3xl p-8 shadow-[0_32px_64px_-16px_rgba(0,0,0,0.1)]">
        <x-validation-errors class="mb-4 text-[10px] text-red-500 font-bold uppercase tracking-wide text-center" />

        <form method="POST" action="{{ route('register') }}" class="space-y-6">
            @csrf

            <!-- Section 1: Basic Identity -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-[11px] font-black uppercase text-stone-500 tracking-[0.1em] ml-1">Full
                        Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" required autofocus
                        class="w-full px-5 py-4 bg-white border border-stone-200 rounded-2xl focus:ring-2 focus:ring-green-600/20 focus:border-green-600 outline-none transition-all text-stone-800 text-[13px] font-medium placeholder-stone-300 shadow-sm"
                        placeholder="Enter your full name">
                </div>

                <div class="space-y-2">
                    <label class="text-[11px] font-black uppercase text-stone-500 tracking-[0.1em] ml-1">Email
                        Address</label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                        class="w-full px-5 py-4 bg-white border border-stone-200 rounded-2xl focus:ring-2 focus:ring-green-600/20 focus:border-green-600 outline-none transition-all text-stone-800 text-[13px] font-medium placeholder-stone-300 shadow-sm"
                        placeholder="name@example.com">
                </div>
            </div>

            <!-- Section 2: Security -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label
                        class="text-[11px] font-black uppercase text-stone-500 tracking-[0.1em] ml-1">Password</label>
                    <div class="relative">
                        <input type="{{ $showPassword ? 'text' : 'password' }}" name="password" required
                            class="w-full pl-5 pr-16 py-4 bg-white border border-stone-200 rounded-2xl focus:ring-2 focus:ring-green-600/20 focus:border-green-600 outline-none transition-all text-stone-800 text-[13px] font-medium placeholder-stone-300 shadow-sm"
                            placeholder="••••••••">
                        <button type="button" wire:click="togglePassword"
                            class="absolute inset-y-0 right-0 pr-6 flex items-center text-stone-400 hover:text-green-600 transition-colors focus:outline-none">
                            @if(!$showPassword)
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 12.066a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                                </svg>
                            @endif
                        </button>
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-[11px] font-black uppercase text-stone-500 tracking-[0.1em] ml-1">Confirm
                        Password</label>
                    <div class="relative">
                        <input type="{{ $showConfirmPassword ? 'text' : 'password' }}" name="password_confirmation"
                            required
                            class="w-full pl-5 pr-16 py-4 bg-white border border-stone-200 rounded-2xl focus:ring-2 focus:ring-green-600/20 focus:border-green-600 outline-none transition-all text-stone-800 text-[13px] font-medium placeholder-stone-300 shadow-sm"
                            placeholder="••••••••">
                        <button type="button" wire:click="toggleConfirmPassword"
                            class="absolute inset-y-0 right-0 pr-6 flex items-center text-stone-400 hover:text-green-600 transition-colors focus:outline-none">
                            @if(!$showConfirmPassword)
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 12.066a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                                </svg>
                            @endif
                        </button>
                    </div>
                </div>
            </div>

            <!-- Section 3: Contact & Logistics -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-[11px] font-black uppercase text-stone-500 tracking-[0.1em] ml-1">Contact
                        Number</label>
                    <div
                        class="flex rounded-2xl border border-stone-200 bg-white shadow-sm overflow-hidden focus-within:ring-2 focus-within:ring-green-600/20 focus-within:border-green-600 transition-all">
                        <span
                            class="inline-flex items-center px-4 border-r border-stone-100 bg-stone-50/50 text-stone-500 text-[13px] font-semibold select-none">
                            +94
                        </span>
                        <input type="text" name="contact_number" value="{{ old('contact_number') }}" required
                            class="w-full px-5 py-4 bg-transparent border-none outline-none focus:ring-0 text-stone-800 text-[13px] font-medium placeholder-stone-300"
                            placeholder="771234567" maxlength="9"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-[11px] font-black uppercase text-stone-500 tracking-[0.1em] ml-1">Address</label>
                    <input type="text" name="address" value="{{ old('address') }}" required
                        class="w-full px-5 py-4 bg-white border border-stone-200 rounded-2xl focus:ring-2 focus:ring-green-600/20 focus:border-green-600 outline-none transition-all text-stone-800 text-[13px] font-medium placeholder-stone-300 shadow-sm"
                        placeholder="Street address, building name, etc.">
                </div>
            </div>

            <!-- Row: City & Postal Code -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-[11px] font-black uppercase text-stone-500 tracking-[0.1em] ml-1">City</label>
                    <input type="text" name="city" value="{{ old('city') }}" required
                        class="w-full px-5 py-4 bg-white border border-stone-200 rounded-2xl focus:ring-2 focus:ring-green-600/20 focus:border-green-600 outline-none transition-all text-stone-800 text-[13px] font-medium placeholder-stone-300 shadow-sm"
                        placeholder="Enter your city" maxlength="50"
                        oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')">
                </div>

                <div class="space-y-2">
                    <label class="text-[11px] font-black uppercase text-stone-500 tracking-[0.1em] ml-1">Postal
                        Code</label>
                    <input type="text" name="postal_code" value="{{ old('postal_code') }}" required
                        class="w-full px-5 py-4 bg-white border border-stone-200 rounded-2xl focus:ring-2 focus:ring-green-600/20 focus:border-green-600 outline-none transition-all text-stone-800 text-[13px] font-medium placeholder-stone-300 shadow-sm"
                        placeholder="e.g. 10100" maxlength="5" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                </div>
            </div>

            <!-- Row: Country (Full Width at Bottom) -->
            <div class="space-y-2">
                <label class="text-[11px] font-black uppercase text-stone-500 tracking-[0.1em] ml-1">Country</label>
                <div class="relative">
                    <input type="text" value="Sri Lanka" readonly
                        class="w-full px-5 py-4 bg-white border border-stone-200 rounded-2xl text-stone-400 text-[13px] font-bold cursor-not-allowed shadow-sm border-dashed">
                    <div class="absolute inset-y-0 right-0 flex items-center pr-6">
                        <span class="text-[9px] font-bold uppercase tracking-widest text-stone-300">Defaulted</span>
                    </div>
                </div>
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                        <div class="flex items-center space-x-3 ml-1">
                            <div class="relative flex items-center w-5 h-5">
                                <input type="checkbox" name="terms" id="terms" required
                                    class="peer absolute opacity-0 w-5 h-5 cursor-pointer z-10">
                                <div
                                    class="w-5 h-5 border border-stone-200 rounded-md bg-stone-50 transition-all peer-checked:bg-green-600 peer-checked:border-green-600 flex items-center justify-center z-0">
                                    <svg class="w-3.5 h-3.5 text-white opacity-0 peer-checked:opacity-100 transition-opacity"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                            </div>
                            <label for="terms"
                                class="text-[10px] font-bold text-stone-400 hover:text-stone-600 transition-colors uppercase tracking-wider select-none cursor-pointer">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                    'terms_of_service' => '<a target="_blank" href="' . route('terms.show') . '" class="text-green-600 hover:underline">' . __('Terms of Service') . '</a>',
                    'privacy_policy' => '<a target="_blank" href="' . route('policy.show') . '" class="text-green-600 hover:underline">' . __('Privacy Policy') . '</a>',
                ]) !!}
                            </label>
                        </div>
            @endif

            <div class="space-y-6 pt-4">
                <button type="submit"
                    class="w-full py-5 bg-stone-900 hover:bg-stone-800 text-white text-[11px] font-black uppercase tracking-[0.3em] rounded-2xl transition-all border border-white/10 shadow-xl shadow-stone-200 active:scale-[0.98]">
                    Complete Registration
                </button>

                <div class="pt-6 border-t border-stone-100/60 flex items-center justify-center">
                    <a href="{{ route('login') }}"
                        class="text-[10px] font-bold text-stone-400 hover:text-green-600 uppercase tracking-[0.2em] transition-colors">
                        Already registered? Sign In
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