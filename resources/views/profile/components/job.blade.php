<a role="button" class="item list-group-item list-group-item-action btn-open-modal-edit-job">
    <data class="d-none">
        <department>{{ $department_id }}</department>
        <major>{{ $major_id }}</major>
        <subject>{{ $subject_id }}</subject>
    </data>
    <div class="d-flex w-100 justify-content-between">
        <h6 class="mb-1 text-primary">Gv. môn {{ $subject }}</h6>
    </div>
    <p class="mb-0">
        Khoa {{ $department }} - Ngành {{ $major }}
    </p>
    <small class="text-muted"><i>Nhấp để sửa</i></small>
</a>