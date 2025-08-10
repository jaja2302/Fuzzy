<?php
function createPagination($current_page, $total_records, $records_per_page, $base_url)
{
    $total_pages = ceil($total_records / $records_per_page);

    if ($total_pages <= 1) {
        return '';
    }

    $start_record = ($current_page - 1) * $records_per_page + 1;
    $end_record = min($current_page * $records_per_page, $total_records);

    $pagination_html = '<div class="pagination-container">';

    // Records info
    $pagination_html .= '<div class="pagination-info">';
    $pagination_html .= "Menampilkan $start_record-$end_record dari $total_records data";
    $pagination_html .= '</div>';

    // Pagination links
    $pagination_html .= '<ul class="pagination">';

    // Previous button
    if ($current_page > 1) {
        $prev_page = $current_page - 1;
        $pagination_html .= '<li><a href="' . $base_url . '&page=' . $prev_page . '" title="Halaman Sebelumnya"><i class="fas fa-chevron-left"></i></a></li>';
    } else {
        $pagination_html .= '<li><span class="disabled"><i class="fas fa-chevron-left"></i></span></li>';
    }

    // Page numbers
    $start_page = max(1, $current_page - 2);
    $end_page = min($total_pages, $current_page + 2);

    if ($start_page > 1) {
        $pagination_html .= '<li><a href="' . $base_url . '&page=1">1</a></li>';
        if ($start_page > 2) {
            $pagination_html .= '<li><span class="disabled">...</span></li>';
        }
    }

    for ($i = $start_page; $i <= $end_page; $i++) {
        if ($i == $current_page) {
            $pagination_html .= '<li><span class="current">' . $i . '</span></li>';
        } else {
            $pagination_html .= '<li><a href="' . $base_url . '&page=' . $i . '">' . $i . '</a></li>';
        }
    }

    if ($end_page < $total_pages) {
        if ($end_page < $total_pages - 1) {
            $pagination_html .= '<li><span class="disabled">...</span></li>';
        }
        $pagination_html .= '<li><a href="' . $base_url . '&page=' . $total_pages . '">' . $total_pages . '</a></li>';
    }

    // Next button
    if ($current_page < $total_pages) {
        $next_page = $current_page + 1;
        $pagination_html .= '<li><a href="' . $base_url . '&page=' . $next_page . '" title="Halaman Selanjutnya"><i class="fas fa-chevron-right"></i></a></li>';
    } else {
        $pagination_html .= '<li><span class="disabled"><i class="fas fa-chevron-right"></i></span></li>';
    }

    $pagination_html .= '</ul>';

    // Records per page selector
    $pagination_html .= '<div class="records-per-page">';
    $pagination_html .= '<label for="records_per_page">Data per halaman:</label>';
    $pagination_html .= '<select id="records_per_page" onchange="changeRecordsPerPage(this.value)">';

    $options = [5, 10, 25, 50, 100];
    foreach ($options as $option) {
        $selected = ($option == $records_per_page) ? 'selected' : '';
        $pagination_html .= '<option value="' . $option . '" ' . $selected . '>' . $option . '</option>';
    }

    $pagination_html .= '</select>';
    $pagination_html .= '</div>';

    $pagination_html .= '</div>';

    // JavaScript for records per page change
    $pagination_html .= '<script>
    function changeRecordsPerPage(records) {
        const url = new URL(window.location);
        url.searchParams.set("records_per_page", records);
        url.searchParams.set("page", 1);
        window.location = url;
    }
    </script>';

    return $pagination_html;
}

function getPaginationData($current_page = 1, $records_per_page = 10)
{
    // Sanitize input
    $current_page = max(1, intval($current_page));
    $records_per_page = max(5, min(100, intval($records_per_page)));

    $offset = ($current_page - 1) * $records_per_page;

    return [
        'current_page' => $current_page,
        'records_per_page' => $records_per_page,
        'offset' => $offset
    ];
}
