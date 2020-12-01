<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CheckExamTurn implements Rule
{
    private $request;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($request)
    {
        $this->request = $request;
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
        if ($this->request->exam == 'MT' && $value == '2') return false; 

        return in_array($value, config('data.exam_turns'));
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
