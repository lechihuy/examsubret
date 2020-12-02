<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Validator as ValidatorFacade;

class CheckExamTimes implements Rule
{
    private $message;
    private $times;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($times)
    {
        $this->times = $times;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $times)
    {
        if ($this->times == 2 && $times == []) return true;

        $validator = ValidatorFacade::make($times, 
            $rules = [
                'origin_exam_qty' => 'bail|required|integer|min:1',
                'exam_code_qty' => 'bail|required|integer|min:1',
            ]
        );

        if ($validator->fails()) {
            $this->message = "[Lần {$this->times}] ".$validator->errors()->first();

            return false;
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
        return $this->message;
    }
}
