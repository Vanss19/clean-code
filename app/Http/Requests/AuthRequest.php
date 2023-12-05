<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
{
    public function rules(): array
    {
        if ($this->route()->named('auth.login')) {
            return [
                'email' => ['required', 'email', 'max:254'],
                'password' => ['required'],
                'remember_token' => ['nullable'],
            ];
        } else {
            return [
                'name' => ['required'],
                'email' => ['required', 'email', 'max:254'],
                'password' => ['required'],
                'remember_token' => ['nullable'],
            ];
        }
    }
}
