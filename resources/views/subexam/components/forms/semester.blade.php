@php $semester = $semester ?? 1 @endphp
<div class="form-group input-group-sm">
    <label class="font-weight-bold d-block">Học kỳ <span class="text-danger">*</span></label>
    @foreach (config('data.semesters') as $value)
    <div class="custom-control custom-radio custom-control-inline">
        <input type="radio" id="semester-{{ $value }}" 
            name="semester" class="custom-control-input" value="{{ $value }}"
            @if ($semester == $value) checked @endif>
        <label class="custom-control-label" for="semester-{{ $value }}" role="button">{{ $value }}</label>
    </div>
    @endforeach
</div>