<?php

namespace Minix\Auth\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SendPasswordResetLink extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email' => 'required|string|email|max:255|exists:users,email',
        ];
    }
}
