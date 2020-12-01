<li role="button" class="list-group-item list-group-item-action {{ $class ?? '' }}">
    <data class="d-none">
        <department>{{ $department->id }}</department>
        <major>{{ $major->id }}</major>
        <subject>{{ $subject->id }}</subject>
    </data>
    <div class="d-flex w-100 justify-content-between">
        <h6 class="mb-1 text-primary">Gv. môn {{ $subject->name }}</h6>
    </div>
    <p class="mb-0">
        Khoa {{ $department->name }} - Ngành {{ $major->name }}
    </p>
    @if (isset($action))
        <small class="text-muted"><i>{{ $action }}</i></small>
    @endif
</li>