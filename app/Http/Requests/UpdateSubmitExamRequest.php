<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\Validator as ValidatorFacade;
use Illuminate\Http\Exceptions\HttpResponseException;

use App\Rules\CheckSemester;
use App\Rules\CheckExam;
use App\Rules\CheckExamForms;
use App\Rules\CheckExamType;

use App\Models\SubmitExamRequest;

class UpdateSubmitExamRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return current_user()->can('edit-subexam', [$this->subexam]);
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        SubmitExamRequest::findOrFail($this->subexam);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'department_id' => ['bail', 'required', 'exists:departments,id'],
            'major_id' => ['bail', 'required', 'exists:majors,id'],
            'subject_id' => ['bail', 'required', 'exists:subjects,id'],
            'class' => ['bail', 'required', 'string'],
            'time' => ['bail', 'required', 'integer', 'min:1'],
            'semester' => ['bail', 'required', new CheckSemester],
            'exam' => ['bail', 'required', new CheckExam],
            'times_1_exam_qty' => ['bail', 'required', 'integer', 'min:1'],
            'times_2_exam_qty' => ['bail', 'nullable', 'sometimes', 'required_if:exam,ET', 'integer', 'min:1'],
            'exam_forms' => ['bail', 'required', new CheckExamForms],
            'exam_form_note' => ['bail', 'nullable', 'sometimes', 'string'],
            'used_material' => ['bail', 'required', 'in:0,1,2'],
            'used_material_note' => ['bail', 'nullable', 'sometimes', 'string'],
            'has_answer' => ['bail', 'required', 'in:0,1'],
            'has_point_ladder' => ['bail', 'required', 'in:0,1'],
            'exam_type' => ['bail', 'required', new CheckExamType],
            'note' => ['bail', 'sometimes', 'nullable', 'string'],
        ];
    }

    public function messages()
    {
        return [
            'department_id.exists' => trans('validation.xss'),
            'major_id.exists' => trans('validation.xss'),
            'subject_id.exists' => trans('validation.xss'),
            'used_material.in' => trans('validation.xss'),
            'has_answer.in' => trans('validation.xss'),
            'has_point_ladder.in' => trans('validation.xss'),
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
