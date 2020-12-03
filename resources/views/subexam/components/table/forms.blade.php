{{ implode(', ', 
    array_map(function($value) {
        return config('data.exam_forms')[$value];
    }, $forms)
) }}