@if ($paginator->hasPages())
    <div class="flex flex-col items-center gap-4">
        <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}"
            class="flex items-center justify-center gap-2">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <span
                    class="relative inline-flex items-center justify-center w-10 h-10 text-stone-300 bg-white border border-stone-200 rounded-lg cursor-default shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </span>
            @else
                <button type="button" wire:click="previousPage" wire:loading.attr="disabled"
                    onclick="window.scrollTo({ top: document.getElementById('gallery-filters').getBoundingClientRect().top + window.scrollY - 150, behavior: 'smooth' })"
                    class="relative inline-flex items-center justify-center w-10 h-10 text-stone-700 bg-white border border-stone-200 rounded-lg hover:bg-stone-50 hover:scale-105 transition-all shadow-sm hover:shadow-md group">
                    <svg class="w-4 h-4 group-hover:-translate-x-0.5 transition-transform" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </button>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <span
                        class="relative inline-flex items-center justify-center w-10 h-10 text-xs font-bold text-stone-400 bg-white border border-stone-200 rounded-lg cursor-default shadow-sm">{{ $element }}</span>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span aria-current="page"
                                class="relative inline-flex items-center justify-center w-10 h-10 text-sm font-black text-stone-900 bg-white border-2 border-stone-900 rounded-lg shadow-md transform scale-105">{{ $page }}</span>
                        @else
                            <button type="button" wire:click="gotoPage({{ $page }})"
                                onclick="window.scrollTo({ top: document.getElementById('gallery-filters').getBoundingClientRect().top + window.scrollY - 150, behavior: 'smooth' })"
                                class="relative inline-flex items-center justify-center w-10 h-10 text-xs font-bold text-stone-500 bg-white border border-stone-200 rounded-lg hover:text-stone-900 hover:border-stone-400 hover:scale-105 transition-all shadow-sm hover:shadow-md">{{ $page }}</button>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <button type="button" wire:click="nextPage" wire:loading.attr="disabled"
                    onclick="window.scrollTo({ top: document.getElementById('gallery-filters').getBoundingClientRect().top + window.scrollY - 150, behavior: 'smooth' })"
                    class="relative inline-flex items-center justify-center w-10 h-10 text-stone-700 bg-white border border-stone-200 rounded-lg hover:bg-stone-50 hover:scale-105 transition-all shadow-sm hover:shadow-md group">
                    <svg class="w-4 h-4 group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>
            @else
                <span
                    class="relative inline-flex items-center justify-center w-10 h-10 text-stone-300 bg-white border border-stone-200 rounded-lg cursor-default shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path>
                    </svg>
                </span>
            @endif
        </nav>

        <p class="text-[10px] font-bold text-stone-400 uppercase tracking-widest mt-1">
            Showing {{ $paginator->count() }} out of {{ $paginator->total() }} Products
        </p>
    </div>
@endif