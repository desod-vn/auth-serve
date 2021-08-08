<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\PhoneNumberCheck;

class UpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|min:3|max:255',
            'birthday' => 'required|date',
            'gender' => 'required|string|max:10',
            'phone' => ['required', 'numeric', new PhoneNumberCheck()],
            'address' => 'required|string|max:255',
            'story' => 'required|string|max:255',
        ];
    }
}
