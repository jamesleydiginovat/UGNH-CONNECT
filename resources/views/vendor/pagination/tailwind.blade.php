@if ($paginator->hasPages())
<nav class="flex flex-col sm:flex-row sm:justify-between items-center mt-4" role="navigation" aria-label="Pagination Navigation">

    <!-- Infos de pagination -->
    <div class="text-sm text-ugnh-blueFonce dark:text-gray-400 mb-2 sm:mb-0">
        @if($paginator->total() > 0)
            Page <span class="font-medium">{{ $paginator->currentPage() }}</span>
            sur <span class="font-medium">{{ $paginator->lastPage() }}</span> |
            Total : <span class="font-medium">{{ $paginator->total() }}</span> résultats
        @else
            Aucun résultat
        @endif
    </div>

    <!-- Liens pagination -->
    <div class="inline-flex shadow-sm rounded-md divide-x divide-gray-300">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="px-3 py-2 bg-gray-200 text-gray-400 cursor-not-allowed rounded-l-md">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                </svg>
            </span>
        @else
            <button wire:click="previousPage" class="px-3 py-2 bg-ugnh-blueClair hover:bg-gray-100 text-gray-700 rounded-l-md flex items-center" aria-label="Page précédente">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                </svg>
            </button>
        @endif

        {{-- Pagination Numbers --}}
        @foreach ($elements as $element)
            @if (is_string($element))
                <span class="px-3 py-2 bg-ugnh-blueClair text-gray-500 cursor-default">{{ $element }}</span>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="px-3 py-2 bg-ugnh-blueFonce text-white font-medium">{{ $page }}</span>
                    @else
                        <button wire:click="gotoPage({{ $page }})" class="px-3 py-2 bg-ugnh-blueClair hover:bg-gray-100 text-gray-700 transition">{{ $page }}</button>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <button wire:click="nextPage" class="px-3 py-2 bg-ugnh-blueClair hover:bg-gray-100 text-gray-700 rounded-r-md flex items-center" aria-label="Page suivante">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                </svg>
            </button>
        @else
            <span class="px-3 py-2 bg-gray-200 text-gray-400 cursor-not-allowed rounded-r-md">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                </svg>
            </span>
        @endif
    </div>

</nav>
@endif
