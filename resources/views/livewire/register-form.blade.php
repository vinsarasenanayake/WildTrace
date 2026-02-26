<div class="w-full max-w-3xl animate-fade-in-up">
    <div class="flex flex-col items-center mb-8">
        <a href="{{ route('home') }}" class="mb-2 group transition-all duration-500">
            <img src="{{ asset('images/logo.png') }}"
                class="w-16 h-16 object-contain group-hover:scale-110 transition-transform">
        </a>
        <h1 class="text-5xl font-serif italic text-stone-900 mb-0">Join WildTrace</h1>
        <p class="text-[10px] font-black text-stone-400 uppercase tracking-[0.3em] mt-1">Create your account
        </p>
    </div>

    <div
        class="bg-white/95 backdrop-blur-3xl border border-stone-200 rounded-3xl p-8 shadow-[0_32px_64px_-16px_rgba(0,0,0,0.1)]">
        <x-validation-errors class="mb-4 text-[10px] text-red-500 font-bold uppercase tracking-wide text-center" />

        <form method="POST" action="{{ route('register') }}" class="space-y-6">
            @csrf

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

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label
                        class="text-[11px] font-black uppercase text-stone-500 tracking-[0.1em] ml-1">Password</label>
                    <x-password-input name="password" required placeholder="••••••••" />
                </div>

                <div class="space-y-2">
                    <label class="text-[11px] font-black uppercase text-stone-500 tracking-[0.1em] ml-1">Confirm
                        Password</label>
                    <x-password-input name="password_confirmation" required placeholder="••••••••" />
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 relative z-30">
                <div class="space-y-2">
                    <label class="text-[11px] font-black uppercase text-stone-500 tracking-[0.1em] ml-1">Contact
                        Number</label>
                    <x-contact-input name="contact_number" :value="old('contact_number')" required
                        placeholder="771234567" />
                </div>

                <div class="space-y-2">
                    <label class="text-[11px] font-black uppercase text-stone-500 tracking-[0.1em] ml-1">Address</label>
                    <input type="text" name="address" value="{{ old('address') }}" required
                        class="w-full px-5 py-4 bg-white border border-stone-200 rounded-2xl focus:ring-2 focus:ring-green-600/20 focus:border-green-600 outline-none transition-all text-stone-800 text-[13px] font-medium placeholder-stone-300 shadow-sm"
                        placeholder="Street address, building name, etc.">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 relative z-20">
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

            <div class="space-y-2 relative z-10">
                <label class="text-[11px] font-black uppercase text-stone-500 tracking-[0.1em] ml-1">Country</label>
                <x-country-select name="country" :selected="old('country', 'Sri Lanka')" required />
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

</div>