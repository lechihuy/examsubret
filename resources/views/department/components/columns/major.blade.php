<a href="{{ route('majors.index', ['department_id' => $department->id]) }}">
    {{ $department->majors->count() }}
</a>