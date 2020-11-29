<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

use App\Models\Department;
use App\Models\Subject;
use App\Models\Major;

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
            if (Department::where('id', $job['department_id'])->doesntExist()
            || Major::where('id', $job['major_id'])->doesntExist()
            || Subject::where('id', $job['subject_id'])->doesntExist()) {
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
