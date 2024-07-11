<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => 'required:email',
            'password' => 'required|min:7'
        ];
    }

    public function messages(): array
    {
        return [
            'email' => 'O campo email é inválido',
            'required' => 'O campo :attribute é obrigatório',
            'password.min' => 'O campo :attribute só pode ter no mínimo :min dígitos',
        ];
    }
}
