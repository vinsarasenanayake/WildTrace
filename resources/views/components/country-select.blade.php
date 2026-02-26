@props(['selected' => 'Sri Lanka'])

@php
    $countries = \App\Helpers\CountryHelper::getAll();
    $name = $attributes->get('name', 'country');
@endphp

<div x-data="{ 
    open: false, 
    selected: '{{ \App\Helpers\CountryHelper::getName($selected) }}',
    countries: {{ json_encode($countries) }},
    get currentCountry() {
        return this.countries.find(c => c.name === this.selected) || this.countries[0];
    },
    selectCountry(name) {
        this.selected = name;
        this.open = false;
        $dispatch('input', name);
    }
}" class="relative w-full">

    <button type="button" @click="open = !open" @click.away="open = false"
        class="w-full px-5 py-4 bg-white border border-stone-200 rounded-2xl flex items-center justify-between hover:border-green-600 transition-all text-stone-800 text-[13px] font-bold shadow-sm focus:outline-none focus:ring-2 focus:ring-green-600/20 active:scale-[0.99]">
        <span x-text="selected"></span>
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"
            :class="open ? 'rotate-180' : ''" class="w-4 h-4 transition-transform text-stone-400">
            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
        </svg>
    </button>

    <input type="hidden" name="{{ $name }}" x-bind:value="selected">

    <div x-show="open" x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
        class="absolute z-[70] w-full mt-2 bg-white border border-stone-200 rounded-2xl shadow-2xl max-h-60 overflow-y-auto country-scroll shadow-green-900/5 group"
        style="display: none;">
        <div class="py-2">
            @foreach($countries as $country)
                <button type="button" @click="selectCountry('{{ $country['name'] }}')"
                    class="w-full px-5 py-3 text-left text-[13px] font-semibold text-stone-700 hover:bg-stone-50 hover:text-green-600 transition-colors flex items-center justify-between group/item">
                    <span>{{ $country['name'] }}</span>
                    <span
                        class="text-[10px] text-stone-300 group-hover/item:text-green-400 font-bold uppercase">{{ $country['code'] }}</span>
                </button>
            @endforeach
        </div>
    </div>
</div>