<?php

declare(strict_types=1);

namespace App\Http\Requests\User;

use App\Enum\Rules\TypeRule;
use App\Utils\Permission\CanAccess;
use Illuminate\Foundation\Http\FormRequest;

class ListRequest extends FormRequest
{
    public function authorize(): bool
    {
        return CanAccess::check('list_user');
    }

    public function rules(): array
    {
        return [
            'type' => 'required|in:' . TypeRule::SELLER->value . ',' . TypeRule::MANAGE->value,
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|string|max:255',
            'limit' => 'nullable|integer',
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'O campo :attribute é obrigatório',
            'string' => 'O campo :attribute deve ser do tipo corda(string)',
            'integer' => 'O campo :attribute deve ser do tipo inteiro(integer)',
            'in' => 'O campo :attribute só aceita valores do tipo :values',
            'max' => 'O campo :attribute só pode ter no máximo :max caracteres'
        ];
    }
}
