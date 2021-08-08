<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HashPasswordCheck implements Rule
{

   
    public function __construct()
    {
        //
    }


    public function passes($attribute, $value)
    {
        $oldPassword = Auth::user()->password;

        if (Hash::check($value, $oldPassword)) {
            return true;
        }
    }

    public function message()
    {
        return 'Mật khẩu cũ không chính xác.';
    }
}
