<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

use App\Models\TeacherJob;

class CheckJobs implements Rule
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
    public function passes($attribute, $jobs)
    {
        $isValid = true;

        foreach ($jobs as $job) {
            if (! TeacherJob::isValid($job)) {
                $isValid = false;
                break;
            }
        }

        return $isValid;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Đã có lỗi xảy ra, vui lòng tải lại trang.';
    }
}
