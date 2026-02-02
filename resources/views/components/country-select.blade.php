@props(['selected' => 'Sri Lanka'])

@php
    // Fetch all countries from the helper
    $countries = \App\Helpers\CountryHelper::getAll();
    $name = $attributes->get('name', 'country');
@endphp

<!-- 
    Country Select Component
    Features: Search-as-you-type autocomplete, custom styling, and 
    Livewire/Standard form compatibility.
-->
<div x-data="{ 
    open: false, 
    search: '{{ $selected }}',
    countries: {{ json_encode($countries) }},
    get filteredCountries() {
        if (this.search === '') return this.countries;
        return this.countries.filter(country => 
            country.name.toLowerCase().includes(this.search.toLowerCase())
        );
    },
    selectCountry(name) {
        this.search = name;
        this.open = false;
        // Dispatch event for Livewire/Standard JS integration
        $dispatch('input', name);
    }
}" class="relative w-full">

    <!-- Search Input -->
    <div class="relative items-center flex">
        <input type="text" x-model="search" @click="open = true" @click.away="open = false" @keyup.escape="open = false"
            placeholder="Search country..." autocomplete="off" required {{ $attributes->merge(['class' => 'w-full px-5 py-4 bg-white border border-stone-200 rounded-2xl focus:ring-2 focus:ring-green-600/20 focus:border-green-600 outline-none transition-all text-stone-800 text-[13px] font-medium placeholder-stone-300 shadow-sm']) }}>
        <!-- Hidden actual input for form submission if name is provided -->
        <input type="hidden" name="{{ $name }}" x-bind:value="search">

        <div class="absolute right-6 pointer-events-none text-stone-400">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                stroke="currentColor" :class="open ? 'rotate-180' : ''" class="size-4 transition-transform">
                <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
            </svg>
        </div>
    </div>

    <!-- Dropdown List -->
    <div x-show="open && filteredCountries.length > 0" x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
        class="absolute z-[70] w-full mt-2 bg-white border border-stone-200 rounded-2xl shadow-2xl max-h-40 overflow-y-auto country-scroll"
        style="display: none;">
        <template x-for="country in filteredCountries" :key="country.code">
            <button type="button" @mousedown="selectCountry(country.name)"
                class="w-full px-5 py-3 text-left text-[13px] font-semibold text-stone-700 hover:bg-stone-50 hover:text-green-600 transition-colors flex items-center justify-between group">
                <span x-text="country.name"></span>
                <span class="text-[10px] text-stone-300 group-hover:text-green-400" x-text="country.code"></span>
            </button>
        </template>
    </div>

    <!-- No results state -->
    <div x-show="open && filteredCountries.length === 0"
        class="absolute z-50 w-full mt-2 bg-white border border-stone-200 rounded-2xl p-4 text-center shadow-xl"
        style="display: none;">
        <p class="text-[11px] font-bold text-stone-400 uppercase tracking-widest">No countries found</p>
    </div>
</div>