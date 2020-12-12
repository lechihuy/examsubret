<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\Validator as ValidatorFacade;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreMajor extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'bail|required|string|unique:majors,name',
            'code' => 'bail|required|string|unique:majors,code',
            'department_id' => 'bail|required|exists:departments,id',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'tên ngành',
            'code' => 'mã ngành',
        ];
    }

    public function messages()
    {
        return [
            'department_id.exists' => trans('validation.xss'),
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
