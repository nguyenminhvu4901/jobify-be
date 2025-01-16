<?php

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

    'accepted' => 'Trường :attribute phải được chấp nhận.',
    'accepted_if' => 'Trường :attribute phải được chấp nhận khi :other là :value.',
    'active_url' => 'Trường :attribute không phải là một URL hợp lệ.',
    'after' => 'Trường :attribute phải là một ngày sau ngày :date.',
    'after_or_equal' => 'Trường :attribute phải là một ngày sau hoặc bằng ngày :date.',
    'alpha' => 'Trường :attribute chỉ được chứa chữ cái.',
    'alpha_dash' => 'Trường :attribute chỉ được chứa chữ cái, số, dấu gạch ngang và gạch dưới.',
    'alpha_num' => 'Trường :attribute chỉ được chứa chữ cái và số.',
    'array' => 'Trường :attribute phải là một mảng.',
    'ascii' => 'Trường :attribute chỉ được chứa ký tự chữ cái và số dạng một byte và các ký tự đặc biệt.',
    'before' => 'Trường :attribute phải là một ngày trước ngày :date.',
    'before_or_equal' => 'Trường :attribute phải là một ngày trước hoặc bằng ngày :date.',
    'between' => [
        'numeric' => 'Trường :attribute phải nằm trong khoảng :min - :max.',
        'file' => 'Dung lượng tập tin trong trường :attribute phải từ :min - :max kB.',
        'string' => 'Trường :attribute phải từ :min - :max ký tự.',
        'array' => 'Trường :attribute phải có từ :min - :max phần tử.',
    ],
    'boolean' => 'Trường :attribute phải là true hoặc false.',
    'confirmed' => 'Xác nhận :attribute không khớp.',
    'current_password' => 'Mật khẩu hiện tại không đúng.',
    'date' => 'Trường :attribute không phải là một ngày hợp lệ.',
    'date_equals' => 'Trường :attribute phải là một ngày bằng với :date.',
    'date_format' => 'Trường :attribute không khớp với định dạng :format.',
    'decimal' => 'Trường :attribute phải có :decimal chữ số thập phân.',
    'declined' => 'Trường :attribute phải bị từ chối.',
    'declined_if' => 'Trường :attribute phải bị từ chối khi :other là :value.',
    'different' => 'Trường :attribute và :other phải khác nhau.',
    'digits' => 'Trường :attribute phải có :digits chữ số.',
    'digits_between' => 'Trường :attribute phải có số chữ số từ :min đến :max.',
    'dimensions' => 'Trường :attribute có kích thước hình ảnh không hợp lệ.',
    'distinct' => 'Trường :attribute có giá trị trùng lặp.',
    'doesnt_end_with' => 'Trường :attribute không được kết thúc bằng các giá trị sau: :values.',
    'doesnt_start_with' => 'Trường :attribute không được bắt đầu bằng các giá trị sau: :values.',
    'email' => ':attribute phải là địa chỉ email hợp lệ.',
    'ends_with' => 'Trường :attribute phải kết thúc bằng một trong các giá trị sau: :values.',
    'enum' => 'Giá trị đã chọn cho :attribute không hợp lệ.',
    'exists' => ':attribute đã chọn không hợp lệ.',
    'file' => 'Trường :attribute phải là một tệp tin.',
    'filled' => 'Trường :attribute phải có giá trị.',
    'gt' => [
        'numeric' => 'Trường :attribute phải lớn hơn :max.',
        'file' => 'Dung lượng tập tin trong trường :attribute phải lớn hơn :max KB.',
        'string' => 'Trường :attribute phải lớn hơn :max ký tự.',
        'array' => 'Trường :attribute phải lớn hơn :max phần tử.',
    ],
    'gte' => [
        'numeric' => 'Trường :attribute phải lớn hơn hoặc bằng :max.',
        'file' => 'Dung lượng tập tin trong trường :attribute phải lớn hơn hoặc bằng :max KB.',
        'string' => 'Trường :attribute phải lớn hơn hoặc bằng :max ký tự.',
        'array' => 'Trường :attribute phải lớn hơn hoặc bằng :max phần tử.',
    ],
    'image' => 'Các tập tin trong trường :attribute phải là định dạng hình ảnh.',
    'in' => 'Giá trị đã chọn trong trường :attribute không hợp lệ.',
    'in_array' => 'The :attribute field does not exist in :other.',
    'integer' => 'Trường :attribute phải là một số nguyên.',
    'ip' => 'Trường :attribute phải là một địa chỉa IP.',
    'ipv4' => 'Trường :attribute phải là địa chỉ IPv4 hợp lệ.',
    'ipv6' => 'Trường :attribute phải là địa chỉ IPv6 hợp lệ.',
    'json' => 'Trường :attribute phải là chuỗi JSON hợp lệ.',
    'lowercase' => 'Trường :attribute phải là chữ in thường.',
    'lt' => [
        'numeric' => 'Trường :attribute phải nhỏ hơn là :min.',
        'file' => 'Dung lượng tập tin trong trường :attribute phải nhỏ hơn :min KB.',
        'string' => 'Trường :attribute phải có nhỏ hơn :min ký tự.',
        'array' => 'Trường :attribute phải có nhỏ hơn :min phần tử.',
    ],
    'lte' => [
        'numeric' => 'Trường :attribute phải nhỏ hơn hoặc bằng là :min.',
        'file' => 'Dung lượng tập tin trong trường :attribute phải nhỏ hơn hoặc bằng :min KB.',
        'string' => 'Trường :attribute phải có nhỏ hơn hoặc bằng :min ký tự.',
        'array' => 'Trường :attribute phải có nhỏ hơn hoặc bằng :min phần tử.',
    ],
    'mac_address' => 'Trường :attribute phải là địa chỉ MAC hợp lệ.',
    'max' => [
        'numeric' => 'Trường :attribute không được lớn hơn :max.',
        'file' => 'Dung lượng tập tin trong trường :attribute không được lớn hơn :max KB.',
        'string' => 'Trường :attribute không được lớn hơn :max ký tự.',
        'array' => 'Trường :attribute không được lớn hơn :max phần tử.',
    ],
    'mimes' => 'Trường :attribute phải là một tập tin có định dạng: :values.',
    'mimetypes' => 'Trường :attribute phải là một tệp có định dạng là: :values.',
    'min' => [
        'numeric' => 'Trường :attribute phải tối thiểu là :min.',
        'file' => 'Dung lượng tập tin trong trường :attribute phải tối thiểu :min KB.',
        'string' => 'Trường :attribute phải có tối thiểu :min ký tự.',
        'array' => 'Trường :attribute phải có tối thiểu :min phần tử.',
    ],
    'min_digits' => 'The :attribute must have at least :min digits.',
    'missing' => 'The :attribute field must be missing.',
    'missing_if' => 'The :attribute field must be missing when :other is :value.',
    'missing_unless' => 'The :attribute field must be missing unless :other is :value.',
    'missing_with' => 'The :attribute field must be missing when :values is present.',
    'missing_with_all' => 'The :attribute field must be missing when :values are present.',
    'multiple_of' => 'The :attribute must be a multiple of :value.',
    'not_in' => 'The selected :attribute is invalid.',
    'not_regex' => 'The :attribute format is invalid.',
    'numeric' => 'The :attribute must be a number.',
    'password' => [
        'letters' => 'Trường :attribute phải chứa ít nhất một chữ cái.',
        'mixed' => 'Trường :attribute phải có ít nhất một chữ hoa và một chữ thường.',
        'numbers' => 'Trường :attribute phải chứa ít nhất một số.',
        'symbols' => 'Trường :attribute phải chứa ít nhất một ký hiệu.',
        'uncompromised' => 'Trường :attribute đã xuất hiện trong một vụ rò rỉ dữ liệu. Vui lòng chọn :attribute khác.',
    ],
    'present' => 'Trường :attribute phải có mặt.',
    'prohibited' => 'Trường :attribute bị cấm.',
    'prohibited_if' => 'Trường :attribute bị cấm khi :other là :value.',
    'prohibited_unless' => 'Trường :attribute bị cấm trừ khi :other nằm trong :values.',
    'regex' => 'Định dạng trường :attribute không hợp lệ.',
    'required' => 'Trường :attribute không được bỏ trống.',
    'required_if' => 'Trường :attribute không được bỏ trống khi trường :other là :value.',
    'required_unless' => 'The :attribute field is required unless :other is in :values.',
    'required_with' => 'Trường :attribute không được bỏ trống khi trường :values có giá trị.',
    'required_with_all' => 'The :attribute field is required when :values is present.',
    'required_without' => 'Trường :attribute không được bỏ trống khi trường :values không có giá trị.',
    'required_without_all' => 'Trường :attribute không được bỏ trống khi tất cả :values không có giá trị.',
    'same' => 'Trường :attribute và :other phải giống nhau.',
    'size' => [
        'numeric' => 'Trường :attribute phải bằng :size.',
        'file' => 'Dung lượng tập tin trong trường :attribute phải bằng :size kB.',
        'string' => 'Trường :attribute phải chứa :size ký tự.',
        'array' => 'Trường :attribute phải chứa :size phần tử.',
    ],
    'starts_with' => 'Trường :attribute phải được bắt đầu bằng một trong những giá trị sau: :values',
    'string' => 'Trường :attribute phải là một chuỗi.',
    'timezone' => 'Trường :attribute phải là một múi giờ hợp lệ.',
    'unique' => 'Trường :attribute đã có trong hệ thống.',
    'uploaded' => 'Trường :attribute không thể tải lên.',
    'url' => 'Trường :attribute không giống với định dạng một URL.',
    'uuid' => 'Trường :attribute không phải là một chuỗi UUID hợp lệ.',
    'uppercase' => 'Trường :attribute phải là chữ in hoa.',
    'password_rule' => 'Trường :attribute phải từ 6-25 ký tự, bao gồm chữ hoa, chữ thường, số và ký tự đặc biệt.',
    'phone_rule' => ':attribute không hợp lệ. Phải từ 10-15 chữ số và có thể bắt đầu bằng dấu "+".',
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

        'the_password_field_is_required_when_type_is_standard' => 'Trường password không được bỏ trống khi trường type là standard.',
        'the_name_field_is_required_when_type_is_standard' => 'Trường name không được bỏ trống khi trường type là standard.',
        "invalid_content_type_value_please_choose_again" => 'Sai giá trị trường Content type, vui lòng chọn lại.'
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
        'email' => 'Email',
        'password' => 'Mật khẩu',
        'full_name' => 'Họ và tên',
        'password_confirmation' => 'Xác nhận mật khẩu',
        'phone_number' => 'Số điện thoại',
        'gender_id' => 'Giới tính',
        'company_name' => 'Tên công ty',
        'province' => 'Tỉnh/Thành phố',
        'district' => 'Quận/Huyện',
        'current_password' => 'Mật khẩu hiện tại',
        'new_password' => 'Mật khẩu mới',
        'new_password_confirmation' => 'Xác nhận mật khẩu mới',
        'user_profile_id' => 'Mã hồ sơ',
        'position' => 'Vị trí',
        'birth_date' => 'Ngày sinh',
        'description' => 'Mô tả',
        'profile_description' => 'Giới thiệu bản thân',
        'avatar' => 'Ảnh đại diện',
        'user_slug' => 'Mã người dùng',
        'user_experience_id' => 'Mã kinh nghiệm',
        'name' => 'Tên',
        'is_working' => 'Đang làm việc tại đây',
        'organization' => 'Tổ chức',
        'is_no_expiration' => 'Ngày hết hạn',
        'start_date' => 'Ngày bắt đầu',
        'end_date' => 'Ngày kết thúc',
        'attachments' => 'Tệp đính kèm',
        'attachments.*.title' => 'Tiêu đề tệp đính kèm',
        'attachments.*.description' => 'Mô tả tệp đính kèm',
        'attachments.*.content_type_id' => 'Loại nội dung tệp đính kèm',
        'attachments.*.image' => 'Ảnh',
        'attachments.*.video' => 'Video',
        'attachments.*.file' => 'Tài liệu',
        'attachments.*.url' => 'Địa chỉ web',
        'attachments.*.user_experience_resource_id' => 'Mã kinh nghiệm tài nguyên người dùng'
    ]
];
