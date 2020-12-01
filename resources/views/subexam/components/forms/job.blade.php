<div class="form-group input-group-sm">
    <label class="font-weight-bold d-block">Công việc <span class="text-danger">*</span></label>
    @if (count($jobs))
        <ul class="list-group select-box" name="job">
            @foreach ($jobs as $job)
                @include('profile.components.job', [
                    'department' => $job->department,
                    'major' => $job->major,
                    'subject' => $job->subject,
                    'class' => 'option',
                    'action' => 'Nhấp để chọn',
                ])
            @endforeach
        </ul>
        <small class="form-text text-muted">Chọn công việc tương ứng với đề thi để hệ thống tự động phân mục khoa, ngành, lớp.</small>
    @else
        <i class="text-muted">Hiện tại chưa có công việc nào, <a href="{{ route('profile.form') }}">cập nhật hồ sơ?</a></i>
    @endif
</div>