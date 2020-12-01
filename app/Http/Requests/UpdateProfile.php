<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\Validator as ValidatorFacade;
use Illuminate\Http\Exceptions\HttpResponseException;

use App\Rules\CheckJobs;

class UpdateProfile extends FormRequest
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
        if (auth('teacher')) {
            $this->merge([
                'jobs' => json_decode($this->jobs, true) ?? []
            ]);
        }
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $user = auth()->user()->id;
        $table = auth('teacher') ? 'teachers' : 'admins';
        $guard = current_guard();

        $rules = [
            'fullname' => 'bail|required|string|min:2|max:50',
            'phone_number' => "bail|required|string|regex:/^[0-9]{10,11}$/|unique:{$table},phone_number,{$user}",
        ];

        if ($this->old_password || $this->new_password || $this->new_password_confirmation) {
            $rules['old_password'] = "required|string|password:{$guard}";
            $rules['new_password'] = 'required|string|confirmed';
        }

        if (auth('teacher')->check()) {
            $rules['jobs'] = ['sometimes', 'nullable', 'array', new CheckJobs];
        }

        return $rules;
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
