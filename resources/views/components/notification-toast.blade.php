@props(['on' => null])

<div x-data="{ 
        show: false, 
        message: '', 
        type: 'success',
        timeout: null,
        init() {
            @if(!request()->routeIs('cart.index'))
                @if(session()->has('success'))
                    setTimeout(() => this.notify('{{ session('success') }}', 'success'), 500);
                @endif
                @if(session()->has('message'))
                    setTimeout(() => this.notify('{{ session('message') }}', 'success'), 500);
                @endif
                @if(session()->has('error') || session()->has('error_message'))
                    setTimeout(() => this.notify('{{ session('error') ?? session('error_message') }}', 'error'), 500);
                @endif
                @if(session()->has('info'))
                    setTimeout(() => this.notify('{{ session('info') }}', 'info'), 500);
                @endif
            @endif

            window.addEventListener('notify', (event) => {
                const payload = event.detail.message ? event.detail : (Array.isArray(event.detail) ? event.detail[0] : event.detail);
                if (payload && payload.message) {
                    this.notify(payload.message, payload.type || 'success');
                }
            });
        },
        notify(message, type) {
            this.message = message;
            this.type = type;
            this.show = true;
            
            if (this.timeout) clearTimeout(this.timeout);
            this.timeout = setTimeout(() => { this.show = false }, 6000);
        }
    }" x-show="show" x-cloak x-transition:enter="transition ease-out duration-500"
    x-transition:enter-start="opacity-0 -translate-y-12 scale-95"
    x-transition:enter-end="opacity-100 translate-y-0 scale-100" x-transition:leave="transition ease-in duration-300"
    x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
    class="fixed top-24 left-1/2 -translate-x-1/2 z-[9999] w-[90%] max-w-lg pointer-events-none" style="display: none;">

    <div
        class="pointer-events-auto bg-stone-900/95 backdrop-blur-2xl rounded-3xl shadow-[0_25px_60px_rgba(0,0,0,0.5)] border border-white/10 p-1 overflow-hidden">
        <div class="bg-gradient-to-b from-white/5 to-transparent rounded-[1.4rem] p-6">
            <div class="flex items-center gap-6">
                <div class="flex-shrink-0 w-14 h-14 rounded-2xl flex items-center justify-center shadow-2xl transform -rotate-3 border border-white/20"
                    :class="{
                        'bg-green-500 text-white': type === 'success',
                        'bg-red-500 text-white': type === 'error',
                        'bg-stone-700 text-white': type === 'info'
                    }">
                    <template x-if="type === 'success'">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                    </template>
                    <template x-if="type === 'error'">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </template>
                    <template x-if="type === 'info'">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </template>
                </div>

                <div class="flex-1">
                    <h4 class="text-[10px] font-black uppercase tracking-[0.3em] mb-1.5 opacity-50" :class="{
                            'text-green-400': type === 'success',
                            'text-red-400': type === 'error',
                            'text-stone-400': type === 'info'
                        }"
                        x-text="type === 'success' ? 'Confirmation Success' : (type === 'error' ? 'System Alert' : 'WildTrace Update')">
                    </h4>
                    <p class="text-base font-bold text-white leading-tight pr-4" x-text="message"></p>
                </div>

                <button @click="show = false"
                    class="p-2 text-white/30 hover:text-white transition-colors rounded-xl hover:bg-white/5 flex-shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                            d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>

    </div>
</div>