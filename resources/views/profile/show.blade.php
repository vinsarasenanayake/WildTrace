<x-guest-layout title="Profile" :fullWidth="true">
    <div
        class="min-h-screen relative overflow-x-hidden bg-stone-50 text-stone-800 font-sans selection:bg-green-600 selection:text-white">

        <div class="fixed inset-0 z-0 pointer-events-none">
            <div class="absolute top-[-20%] left-[-10%] w-[800px] h-[800px] bg-green-600/5 rounded-full blur-[150px]">
            </div>
            <div
                class="absolute bottom-[-20%] right-[-10%] w-[600px] h-[600px] bg-stone-400/10 rounded-full blur-[100px]">
            </div>
        </div>

        <div class="relative z-10 max-w-5xl mx-auto py-10 px-6 lg:px-8">

            <div class="mb-12 text-center animate-fade-in-up">
                <div class="flex justify-center mb-10">
                    <a href="/">
                        <img src="{{ asset('images/logo.png') }}"
                            class="w-20 h-20 object-contain opacity-90 hover:opacity-100 transition-opacity">
                    </a>
                </div>
                <a href="{{ route('dashboard') }}"
                    class="inline-flex items-center gap-2 text-[10px] font-black uppercase tracking-[0.2em] text-stone-400 hover:text-green-600 mb-6 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                    </svg>
                    Back to Dashboard
                </a>
                <h2 class="text-4xl md:text-5xl font-serif italic text-stone-900 leading-none">
                    Edit Profile
                </h2>
            </div>

            <div class="space-y-10 animate-fade-in" style="animation-delay: 0.1s;">
                @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                    <div
                        class="bg-white/80 backdrop-blur-xl border border-stone-200 rounded-[2.5rem] p-8 md:p-12 shadow-xl">
                        @livewire('profile.update-profile-information-form')
                    </div>
                @endif

                @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                    <div
                        class="bg-white/80 backdrop-blur-xl border border-stone-200 rounded-[2.5rem] p-8 md:p-12 shadow-xl">
                        @livewire('profile.update-password-form')
                    </div>
                @endif

                @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                    <div
                        class="bg-white/80 backdrop-blur-xl border border-stone-200 rounded-[2.5rem] p-8 md:p-12 shadow-xl">
                        @livewire('profile.two-factor-authentication-form')
                    </div>
                @endif

                <div
                    class="bg-white/80 backdrop-blur-xl border border-stone-200 rounded-[2.5rem] p-8 md:p-12 shadow-xl">
                    @livewire('profile.logout-other-browser-sessions-form')
                </div>

                @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
                    <div class="bg-red-50/50 backdrop-blur-xl border border-red-100 rounded-[2.5rem] p-8 md:p-12 shadow-xl">
                        @livewire('profile.delete-user-form')
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-guest-layout>