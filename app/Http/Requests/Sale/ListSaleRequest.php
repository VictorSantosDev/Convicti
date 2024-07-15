<?php

declare(strict_types=1);

namespace App\Http\Requests\Sale;

use App\Utils\Permission\CanAccess;
use Illuminate\Foundation\Http\FormRequest;

class ListSaleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return CanAccess::check('list_sale');
    }

    public function rules(): array
    {
        return [
            'dateInitial' => 'required|date',
            'dateFinal' => 'required|date',
            'userId' => 'nullable|integer',
            'pointOfSaleId' => 'nullable|integer',
            'boardId' => 'nullable|integer',
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'O campo :attribute é obrigatório',
            'date' => 'O campo :attribute é uma data válida',
            'integer' => 'O campo :attribute deve receber um valor do tipo inteiro(integer)',
        ];
    }
}
