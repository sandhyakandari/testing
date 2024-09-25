@if ($paginator->hasPages())
    <ul class="pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="paginate_button page-item disabled" id="example1_previous">
                <span>
                    <i class="fa fa-chevron-left"></i>
                </span>
            </li>
        @else
            <li class="paginate_button page-item previous disabled" id="example1_previous">
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="page-link">
                    <i class="fa fa-chevron-left"></i>
                </a>
            </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="paginate_button page-item disabled"><span>{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="paginate_button page-item active"><span>{{ $page }}</span></li>
                    @else
                        <li class="paginate_button page-item"><a href="{{ $url }}"
                                class="page-link">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="paginate_button page-item">
                <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="page-link">
                    <i class="fa fa-chevron-right"></i>
                </a>
            </li>
        @else
            <li class="paginate_button page-item disabled">
                <span><i class="fa fa-chevron-right"></i>
                </span>
            </li>
        @endif
    </ul>
@endif
