<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\Validator as ValidatorFacade;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateProfileAdmin extends FormRequest
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
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $admin = auth()->user()->id;
        
        return [
            'fullname' => 'bail|required|string|min:2|max:50',
            'phone_number' => "bail|required|string|min:10|max:11|unique:admins,phone_number,{$admin}",
            'email' => "bail|required|string|email|unique:admins,email,{$admin}",
            'old_password' => 'sometimes|nullable|string|password:admin',
            'new_password' => 'sometimes|nullable|required_with:old_password|string|confirmed',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'error' => [
                    'code' => 422,
                    'message' => $validator->errors()->first()
                ]
            ], 422)
        );
    }
}
