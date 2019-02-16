<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center pagination-sm">
        <li class="page-item {{ $meta['current_page'] <= 1 ? 'disabled' : '' }}">
            <a class="page-link" href="/?page={{ $meta['current_page'] - 1 }}&orderBy={{ $meta['orderBy'] }}&direction={{ $meta['direction'] }}">
                <span aria-hidden="true">&laquo;</span>
            </a>
        </li>
        @for($i = 1; $i <= $meta['last_page']; $i++)
            <li class="page-item {{ $meta['current_page'] == $i ? 'active' : '' }}">
                <a class="page-link" href="/?page={{ $i }}&orderBy={{ $meta['orderBy'] }}&direction={{ $meta['direction'] }}">{{ $i }}</a>
            </li>
        @endfor
        <li class="page-item {{ $meta['current_page'] >= $meta['last_page'] ? 'disabled' : '' }}">
            <a class="page-link" href="/?page={{ $meta['current_page'] + 1 }}&orderBy={{ $meta['orderBy'] }}&direction={{ $meta['direction'] }}">
                <span aria-hidden="true">&raquo;</span>
            </a>
        </li>
    </ul>
</nav>
