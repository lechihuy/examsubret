@foreach ($subject->departments as $department)
    <a href="{{ route('departments.edit', $department->id) }}" class="d-block">{{ $department->name }}</a>
@endforeach