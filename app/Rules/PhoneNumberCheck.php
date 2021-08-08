<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class PhoneNumberCheck implements Rule
{
    public function __construct()
    {
        //
    }

    public function passes($attribute, $value)
    {
        return preg_match('/(\+84|0[0-9])+([0-9]+)\b/ ', $value) && strlen($value) >= 10;
    }

    public function message()
    {
        return 'Số điện thoại bắt đầu bằng số 0 hoặc dấu +,chỉ được chứa dấu + và số, chứa ít nhất 10 ký tự ';
    }
}
