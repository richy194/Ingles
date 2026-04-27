@if ($paginator->hasPages())
    <nav class="pager-nav" role="navigation" aria-label="Paginacion">
        <div class="pager-left">
            @if ($paginator->onFirstPage())
                <span class="pager-btn is-disabled">Anterior</span>
            @else
                <a class="pager-btn" href="{{ $paginator->previousPageUrl() }}">Anterior</a>
            @endif

            @if ($paginator->hasMorePages())
                <a class="pager-btn" href="{{ $paginator->nextPageUrl() }}">Siguiente</a>
            @else
                <span class="pager-btn is-disabled">Siguiente</span>
            @endif
        </div>

        <div class="pager-right">
            <span class="pager-text">
                Pagina {{ $paginator->currentPage() }} de {{ $paginator->lastPage() }}
            </span>
        </div>
    </nav>
@endif
