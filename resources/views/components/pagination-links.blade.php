@if ($paginator->hasPages())
    <div class="pagination-area text-center">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="page-numbers disabled"><i class="bx bx-chevron-left"></i></span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="page-numbers"><i class="bx bx-chevron-left"></i></a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($paginator->elements() as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <span class="page-numbers disabled">{{ $element }}</span>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="page-numbers current" aria-current="page">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="page-numbers">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="page-numbers"><i class="bx bx-chevron-right"></i></a>
        @else
            <span class="page-numbers disabled"><i class="bx bx-chevron-right"></i></span>
        @endif
    </div>
@endif
