<td class="text-center d-none d-md-table-cell">
    {{ implode(', ', 
        array_map(function($value) {
            return config('data.exam_forms')[$value];
        }, $forms)
    ) }}
</td>