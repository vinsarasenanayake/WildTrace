@props(['dialCode' => '+94', 'value' => ''])

@php
    $countries = \App\Helpers\CountryHelper::getAll();
    $dialCodeName = $attributes->get('dial-code-name', 'dial_code');
@endphp

<div x-data="{ 
    open: false, 
    selected: '{{ $dialCode }}'
}" :class="open ? 'relative z-[9999]' : 'relative z-10'"
    class="flex rounded-2xl border border-stone-200 bg-white shadow-sm focus-within:ring-2 focus-within:ring-green-600/20 focus-within:border-green-600 transition-all">



    <div class="relative flex-shrink-0">
        <button type="button" @click="open = !open" @click.away="open = false"
            class="h-full px-5 flex items-center gap-3 bg-stone-50/50 hover:bg-stone-100 transition-colors text-stone-800 text-[13px] font-black select-none focus:outline-none min-w-[100px] justify-between border-r border-stone-100 rounded-l-2xl">
            <span x-text="selected"></span>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3.5"
                stroke="currentColor" :class="open ? 'rotate-180' : ''"
                class="w-3 h-3 transition-transform text-stone-600">
                <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
            </svg>
        </button>

        <input type="hidden" name="{{ $dialCodeName }}" x-model="selected">

        <div x-show="open" x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
            class="absolute z-[70] w-80 mt-2 bg-white border border-stone-200 rounded-2xl shadow-2xl max-h-40 overflow-y-auto"
            style="display: none;">
            <div class="max-h-[140px] overflow-y-auto py-2">
                @foreach($countries as $country)
                    <button type="button" @click="selected = '{{ $country['dial_code'] }}'; open = false;"
                        class="w-full px-5 py-3 text-left text-[12px] font-semibold text-stone-700 hover:bg-stone-50 flex items-center justify-between group transition-colors">
                        <span class="truncate pr-2">{{ $country['name'] }}</span>
                        <span class="text-stone-400 group-hover:text-green-600 font-bold">{{ $country['dial_code'] }}</span>
                    </button>
                @endforeach
            </div>
        </div>
    </div>

    <input {{ $attributes->merge(['class' => 'w-full px-5 py-4 bg-transparent border-none outline-none focus:ring-0 text-stone-800 text-[13px] font-medium placeholder-stone-300 rounded-r-2xl']) }} maxlength="9"
        oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 9)">
</div>