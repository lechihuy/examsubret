<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\Validator as ValidatorFacade;
use Illuminate\Http\Exceptions\HttpResponseException;

use App\Rules\CheckSemester;
use App\Rules\CheckExam;

class StoreSubmitExamRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return current_user()->can('create-subexam');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'semester' => ['bail', 'required', 'string', new CheckSemester],
            'exam' => ['bail', 'required', 'string', new CheckExam],
            'department_id' => ['bail', 'required', 'exists:departments,id'],
            'major_id' => ['bail', 'required', 'exists:majors,id'],
            'subject_id' => ['bail', 'required', 'exists:subjects,id'],
            'times' => ['bail', 'required', 'string', 'max:50', 'regex:/^[0-9]+$/'],
            'test_quantity' => ['bail', 'required', 'numeric', 'min:1'],
            'time' => ['bail', 'required', 'numeric', 'min:1'],
            'note' => ['bail', 'sometimes', 'nullable', 'string'],
        ];
    }

    public function messages()
    {
        return [
            'department_id.required' => 'Vui lòng chọn một công việc.',
            'major_id.required' => 'Vui lòng chọn một công việc.',
            'subject_id.required' => 'Vui lòng chọn một công việc.',
            'department_id.exists' => trans('validation.xss'),
            'major_id.exists' => trans('validation.xss'),
            'subject_id.exists' => trans('validation.xss'),
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'message' => $validator->errors()->first()
            ], 422)
        );
    }
}
