<a role="button" class="item list-group-item list-group-item-action btn-open-modal-edit-job">
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
    <small class="text-muted"><i>Nhấp để sửa</i></small>
</a>