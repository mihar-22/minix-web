<?php

namespace Minix\Auth\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResetPassword extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email' => 'required|string|email|max:255',
            'token' => 'required|string|max:255',
            'password' => 'required|string|min:6',
        ];
    }
}
