<a href="{{ route('subjects.index', ['department_id' => $department->id]) }}">
    {{ $department->subjects->count() }}
</a>