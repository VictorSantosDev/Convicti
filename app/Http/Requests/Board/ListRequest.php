<?php

declare(strict_types=1);

namespace App\Http\Requests\Board;

use Illuminate\Foundation\Http\FormRequest;

class ListRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // list_boards
    }

    public function rules(): array
    {
        return [
            'name' => 'nullable|max:255',
            'limit' => 'nullable|integer',
        ];
    }

    public function messages(): array
    {
        return [
            'max' => 'O campo :attribute só pode ter no máximo :max caracteres',
            'integer' => 'O campo :attribute deve ser do tipo inteiro(integer)',
        ];
    }
}
