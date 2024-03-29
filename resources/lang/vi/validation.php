<?php

use App\Models\SubmitExamRequest;

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'The :attribute must be accepted.',
    'active_url' => 'The :attribute is not a valid URL.',
    'after' => 'The :attribute must be a date after :date.',
    'after_or_equal' => 'The :attribute must be a date after or equal to :date.',
    'alpha' => 'The :attribute may only contain letters.',
    'alpha_dash' => 'The :attribute may only contain letters, numbers, dashes and underscores.',
    'alpha_num' => 'The :attribute may only contain letters and numbers.',
    'array' => 'The :attribute must be an array.',
    'before' => 'The :attribute must be a date before :date.',
    'before_or_equal' => 'The :attribute must be a date before or equal to :date.',
    'between' => [
        'numeric' => 'The :attribute must be between :min and :max.',
        'file' => 'The :attribute must be between :min and :max kilobytes.',
        'string' => 'The :attribute must be between :min and :max characters.',
        'array' => 'The :attribute must have between :min and :max items.',
    ],
    'boolean' => ':Attribute phải ở dạng boolean.',
    'confirmed' => 'Xác nhận lại :attribute không khớp.',
    'date' => 'The :attribute is not a valid date.',
    'date_equals' => 'The :attribute must be a date equal to :date.',
    'date_format' => ':Attribute không đúng định dạng.',
    'different' => 'The :attribute and :other must be different.',
    'digits' => 'The :attribute must be :digits digits.',
    'digits_between' => 'The :attribute must be between :min and :max digits.',
    'dimensions' => 'The :attribute has invalid image dimensions.',
    'distinct' => 'The :attribute field has a duplicate value.',
    'email' => ':Attribute không hợp lệ.',
    'ends_with' => 'The :attribute must end with one of the following: :values.',
    'exists' => 'The selected :attribute is invalid.',
    'file' => ':Attribute phải là một file.',
    'filled' => 'The :attribute field must have a value.',
    'gt' => [
        'numeric' => 'The :attribute must be greater than :value.',
        'file' => 'The :attribute must be greater than :value kilobytes.',
        'string' => 'The :attribute must be greater than :value characters.',
        'array' => 'The :attribute must have more than :value items.',
    ],
    'gte' => [
        'numeric' => 'The :attribute must be greater than or equal :value.',
        'file' => 'The :attribute must be greater than or equal :value kilobytes.',
        'string' => 'The :attribute must be greater than or equal :value characters.',
        'array' => 'The :attribute must have :value items or more.',
    ],
    'image' => 'The :attribute must be an image.',
    'in' => 'Giá trị :attribute không hợp lệ.',
    'in_array' => 'The :attribute field does not exist in :other.',
    'integer' => ':Attribute phải là số nguyên.',
    'ip' => 'The :attribute must be a valid IP address.',
    'ipv4' => 'The :attribute must be a valid IPv4 address.',
    'ipv6' => 'The :attribute must be a valid IPv6 address.',
    'json' => 'The :attribute must be a valid JSON string.',
    'lt' => [
        'numeric' => 'The :attribute must be less than :value.',
        'file' => 'The :attribute must be less than :value kilobytes.',
        'string' => 'The :attribute must be less than :value characters.',
        'array' => 'The :attribute must have less than :value items.',
    ],
    'lte' => [
        'numeric' => 'The :attribute must be less than or equal :value.',
        'file' => ':Attribute phải có dung lượng ít hơn hoặc bằng :value kilobytes.',
        'string' => 'The :attribute must be less than or equal :value characters.',
        'array' => 'The :attribute must not have more than :value items.',
    ],
    'max' => [
        'numeric' => 'The :attribute may not be greater than :max.',
        'file' => 'The :attribute may not be greater than :max kilobytes.',
        'string' => ':Attribute chỉ được dài tối đa :max ký tự.',
        'array' => 'The :attribute may not have more than :max items.',
    ],
    'mimes' => ':Attribute phải có các định dạng sau: :values.',
    'mimetypes' => 'The :attribute must be a file of type: :values.',
    'min' => [
        'numeric' => ':Attribute phải lớn hơn :min.',
        'file' => 'The :attribute must be at least :min kilobytes.',
        'string' => ':Attribute phải dài ít nhất :min ký tự.',
        'array' => 'The :attribute must have at least :min items.',
    ],
    'multiple_of' => 'The :attribute must be a multiple of :value',
    'not_in' => 'The selected :attribute is invalid.',
    'not_regex' => 'The :attribute format is invalid.',
    'numeric' => 'The :attribute must be a number.',
    'password' => ':Attribute không chính xác.',
    'present' => 'The :attribute field must be present.',
    'regex' => ':Attribute không đúng định dạng.',
    'required' => ':Attribute là bắt buộc.',
    'required_if' => ':Attribute là bắt buộc khi :other là :value.',
    'required_unless' => 'The :attribute field is required unless :other is in :values.',
    'required_with' => ':Attribute là bắt buộc khi :values được nhập.',
    'required_with_all' => 'The :attribute field is required when :values are present.',
    'required_without' => 'The :attribute field is required when :values is not present.',
    'required_without_all' => 'The :attribute field is required when none of :values are present.',
    'same' => 'The :attribute and :other must match.',
    'size' => [
        'numeric' => 'The :attribute must be :size.',
        'file' => 'The :attribute must be :size kilobytes.',
        'string' => 'The :attribute must be :size characters.',
        'array' => 'The :attribute must contain :size items.',
    ],
    'starts_with' => 'The :attribute must start with one of the following: :values.',
    'string' => ':Attribute phải là chuỗi.',
    'timezone' => 'The :attribute must be a valid zone.',
    'unique' => ':Attribute đã được sử dụng.',
    'uploaded' => 'The :attribute failed to upload.',
    'url' => 'The :attribute format is invalid.',
    'uuid' => 'The :attribute must be a valid UUID.',
    'xss' => 'Đã có lỗi xảy ra, vui lòng tải lại trang và thử lại.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    'values' => [
        'exam' => SubmitExamRequest::data('exams')
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
        'fullname' => 'tên đầy đủ',
        'phone_number' => 'số điện thoại',
        'email' => 'địa chỉ email',
        'old_password' => 'mật khẩu cũ',
        'new_password' => 'mật khẩu mới',
        'is_locked' => 'khoá tài khoản',

        'semester' => 'học kỳ',
        'exam' => 'kỳ thi',
        'time' => 'thời gian làm bài',
        'department_id' => 'khoa',
        'major_id' => 'ngành',
        'subject_id' => 'môn',
        'times_1_exam_qty' => 'số đề đợt 1',
        'times_2_exam_qty' => 'số đề đợt 2',
        'exam_forms' => 'hình thức thi',
        'created_at' => 'ngày tạo',
        'class' => 'nhóm lớp học phần',
        'exam_form_note' => 'chú thích về hình thức thi',
        'used_material' => 'được sử dụng tài liệu',
        'used_material_note' => 'liệt kê các tài liệu được phép sử dụng.',
        'has_answer' => 'đề thi có kèm đáp án',
        'has_point_ladder' => 'đề thi có kèm thang điểm',
        'exam_types' => 'đề thi thuộc loại',
        'avatar' => 'ảnh đại diện'
    ],

];
