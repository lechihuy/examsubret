@php $exam = $exam ?? 'MT' @endphp
<div class="form-group input-group-sm">
    <label class="font-weight-bold d-block">Kỳ thi <span class="text-danger">*</span></label>
    @foreach (config('data.exams') as $code => $name)
    <div class="custom-control custom-radio custom-control-inline">
        <input type="radio" id="exam-{{ $code }}" 
            name="exam" class="custom-control-input" value="{{ $code }}"
            @if ($exam == $code) checked @endif>
        <label class="custom-control-label" for="exam-{{ $code }}" role="button">{{ $name }}</label>
    </div>
    @endforeach
</div>