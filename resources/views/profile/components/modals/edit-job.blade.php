<div class="modal fade show" id="modal-edit-job" tabindex="-1"
    action="{{ route('components.load', [
        'view' => 'profile.components.job',
        'handle' => 'handleJobComponent'
    ]) }}"
    list="#list-jobs">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-light border-bottom-0">
                <h6 class="modal-title">Sửa thông tin công việc</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{-- Department --}}
                <div class="form-group input-group-sm">
                    <label class="font-weight-bold">Khoa <span class="text-danger">*</span></label>
                    <select name="department" style="width: 100%;">
                        <option value="">-- Chọn khoa -- </option>
                        @foreach($departments as $department)
                            <option value="{{ $department->id }}">
                                [{{ $department->code}}] {{ $department->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                {{-- /Department --}}

                {{-- Major --}}
                <div class="form-group input-group-sm">
                    <label class="font-weight-bold">Ngành <span class="text-danger">*</span></label>
                    <select name="major" style="width: 100%;"></select>
                </div>
                {{-- /Major --}}
                
                {{-- Subject --}}
                <div class="form-group input-group-sm mb-0">
                    <label class="font-weight-bold">Môn <span class="text-danger">*</span></label>
                    <select name="subject" style="width: 100%;"></select>
                </div>
                {{-- /Subject --}}

                <div class="alert d-none mt-3 mb-0" form="#modal-edit-job"></div>
            </div>
            <div class="modal-footer border-top-0 bg-light">
                <button type="button" class="btn btn-outline-danger btn-sm mr-auto btn-delete" data-dismiss="modal">
                    <i class="fas fa-trash-alt"></i> Xoá
                </button>
                <button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Hủy</button>
                <button type="button" class="btn btn-success btn-confirm btn-sm"><i class="fas fa-check"></i> Lưu</button>
            </div>
        </div>
    </div>
</div>