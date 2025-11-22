<?php
// Config
$link_limit = 8; // Maximum number of links
?>
<style>
.pagination {
    text-align: center;
    margin: 30px 0;
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 5px;
}

.pagination li {
    list-style: none;
}

.pagination a {
    color: #333;
    text-decoration: none;
    padding: 8px 12px;
    border: 1px solid #ddd;
    border-radius: 4px;
    transition: all 0.3s ease;
    font-size: 14px;
}

.pagination a:hover {
    background-color: #fc3b56;
    color: #fff;
    border-color: #fc3b56;
}

.pagination li.active a {
    background-color: #fc3b56;
    color: #fff;
    border-color: #fc3b56;
}

.pagination li.disabled a {
    color: #ccc;
    pointer-events: none;
    border-color: #ddd;
}

.pagination__item--arrow svg {
    width: 16px;
    height: 16px;
    fill: currentColor;
    vertical-align: middle;
    transition: transform 0.3s ease;
}

.pagination__item--arrow:hover svg {
    transform: scale(1.2);
}
</style>

@if ($paginator->lastPage() > 1)
    <ul class="pagination">
        <!-- Previous Button -->
        <li class="pagination__list {{ ($paginator->currentPage() == 1) ? 'disabled' : '' }}">
            <a class="pagination__item--arrow link" href="{{ $paginator->url($paginator->currentPage() - 1) }}" title="Previous">
                <svg xmlns="http://www.w3.org/2000/svg" width="22.51" height="20.443" viewBox="0 0 512 512">
                    <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="48" d="M244 400L100 256l144-144M120 256h292" />
                </svg>
            </a>
        </li>

        <!-- Pagination Links -->
        <?php
        $half_total_links = floor($link_limit / 2);
        $from = $paginator->currentPage() - $half_total_links;
        $to = $paginator->currentPage() + $half_total_links;
        if ($from < 1) {
            $from = 1;
            $to = $link_limit;
        }
        if ($to > $paginator->lastPage()) {
            $to = $paginator->lastPage();
            $from = $paginator->lastPage() - $link_limit + 1;
            if ($from < 1) {
                $from = 1;
            }
        }
        ?>
        @for ($i = $from; $i <= $to; $i++)
            <li class="pagination__list {{ ($paginator->currentPage() == $i) ? 'active' : '' }}">
                <a class="link" href="{{ $paginator->url($i) }}">{{ $i }}</a>
            </li>
        @endfor

        <!-- Next Button -->
        <li class="pagination__list {{ ($paginator->currentPage() == $paginator->lastPage()) ? 'disabled' : '' }}">
            <a class="pagination__item--arrow link" href="{{ $paginator->url($paginator->currentPage() + 1) }}" title="Next">
                <svg xmlns="http://www.w3.org/2000/svg" width="22.51" height="20.443" viewBox="0 0 512 512">
                    <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="48" d="M268 112l144 144-144 144M392 256H100" />
                </svg>
            </a>
        </li>
    </ul>
@endif
