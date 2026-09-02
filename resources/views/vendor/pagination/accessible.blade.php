{{--
    Accessible pagination.

    Differs from Laravel's stock bootstrap-4 view in three ways that matter for
    WCAG 2.2 AA:
      * Previous/Next are real words for screen readers, not bare arrow glyphs
        (the arrows are aria-hidden decoration alongside them).
      * Every numbered link carries an aria-label naming the page.
      * The current page is marked with aria-current="page", so it is not
        conveyed by background colour alone.
--}}
@if ($paginator->hasPages())
    <ul class="pagination">
        {{-- Previous --}}
        @if ($paginator->onFirstPage())
            <li class="page-item disabled">
                <span class="page-link" aria-disabled="true">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="lc-visually-hidden">Poprzednia strona (niedostępna)</span>
                </span>
            </li>
        @else
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev"
                   aria-label="Przejdź do poprzedniej strony, strona {{ $paginator->currentPage() - 1 }}">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="lc-visually-hidden">Poprzednia</span>
                </a>
            </li>
        @endif

        {{-- Page numbers --}}
        @foreach ($elements as $element)
            @if (is_string($element))
                <li class="page-item disabled">
                    <span class="page-link" aria-hidden="true">{{ $element }}</span>
                    <span class="lc-visually-hidden">Pominięto część numerów stron</span>
                </li>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item active">
                            <span class="page-link" aria-current="page">
                                <span class="lc-visually-hidden">Strona</span>
                                {{ $page }}
                                <span class="lc-visually-hidden">, bieżąca strona</span>
                            </span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $url }}" aria-label="Przejdź do strony {{ $page }}">
                                {{ $page }}
                            </a>
                        </li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next --}}
        @if ($paginator->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next"
                   aria-label="Przejdź do następnej strony, strona {{ $paginator->currentPage() + 1 }}">
                    <span class="lc-visually-hidden">Następna</span>
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        @else
            <li class="page-item disabled">
                <span class="page-link" aria-disabled="true">
                    <span class="lc-visually-hidden">Następna strona (niedostępna)</span>
                    <span aria-hidden="true">&raquo;</span>
                </span>
            </li>
        @endif
    </ul>
@endif
