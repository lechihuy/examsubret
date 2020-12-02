@if ($times != null) 
    <td class="text-center d-none d-md-table-cell">{{ $times->get('origin_exam_qty') }}</td>
    <td class="text-center d-none d-md-table-cell">{{ $times->get('exam_code_qty') }}</td>
@else
    <td class="text-center d-none d-md-table-cell">-</td>
    <td class="text-center d-none d-md-table-cell">-</td>
@endif
