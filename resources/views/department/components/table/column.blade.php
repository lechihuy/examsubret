@if ($column['is_visible'])
    <td class="text-center d-none d-md-table-cell">
        @include($render)
    </td>
@endif