<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\Validator as ValidatorFacade;
use Illuminate\Http\Exceptions\HttpResponseException;

use App\Rules\CheckSemester;
use App\Rules\CheckExam;
use App\Rules\CheckExamTurn;

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
            'department_id' => ['bail', 'required', 'exists:departments,id'],
            'major_id' => ['bail', 'required', 'exists:majors,id'],
            'subject_id' => ['bail', 'required', 'exists:subjects,id'],
            'semester' => ['bail', 'required', 'string', new CheckSemester],
            'exam' => ['bail', 'required', 'string', new CheckExam],
            'exam_turn' => ['bail', 'required', new CheckExamTurn($this)],
            'time' => ['bail', 'required', 'integer', 'min:1'],
            'note' => ['bail', 'sometimes', 'nullable', 'string'],
        ];
    }

    public function messages()
    {
        return [
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
