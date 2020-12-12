<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

use App\Models\Department;

class CheckDepartments implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $value = $value ? explode(',', $value) : [];
        
        return Department::whereIn('id', $value)->exists();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('xss.validation');
    }
}
