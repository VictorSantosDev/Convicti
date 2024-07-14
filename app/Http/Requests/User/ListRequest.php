<?php

declare(strict_types=1);

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class ListRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // list_user
    }

    public function rules(): array
    {
        return [
            //
        ];
    }
}
