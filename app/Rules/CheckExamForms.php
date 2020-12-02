<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CheckExamForms implements Rule
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
        $examForms = array_keys(config('data.exam_forms'));
        
        foreach ($value as $key) {
            if (! in_array($key, $examForms)) return false;
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('validation.xss');
    }
}
