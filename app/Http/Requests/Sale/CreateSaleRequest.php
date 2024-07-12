<?php

declare(strict_types=1);

namespace App\Http\Requests\Sale;

use App\Domain\Sale\Entity\Sale;
use App\Domain\Sale\Factories\Factory\SaleFactory;
use Closure;
use Illuminate\Foundation\Http\FormRequest;

class CreateSaleRequest extends FormRequest
{
    const REGEX_HOUR = "/^(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/";

    public function authorize(): bool
    {
        return true; // create_sale
    }

    public function rules(): array
    {
        return [
            'saleValue' => 'required|numeric|string|max_digits:10|min:1',
            'date' => 'required|string|date|after:yesterday',
            'hour' => [
                'required',
                'string',
                function (string $attribute, mixed $value, Closure $fail) {
                    if (!preg_match(self::REGEX_HOUR, $value)) {
                        $fail("O campo $attribute está com a hora superior ou formatado de forma inválida");
                    }
                },
            ],
            'latitude' => 'required|string',
            'longitude' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'O campo :attribute é obrigatório',
            'date' => 'O campo :attribute está com formato de data inválido',
            'data.after' => 'O campo :attribute não pode ter uma data inferior a data atual',
            'string' => 'O campo :attribute deve ser do tipo corda(string)',
            'saleValue.max_digits' => 'O campo :attribute só pode ter no maxímo 10 casas',
            'saleValue.numeric' => 'O campo :attribute só pode ser do tipo corda(string) inteiras',
            'saleValue.min' => 'O campo :attribute só pode ter no minímo :min dígito',
        ];
    }

    public function data(): Sale
    {
        $saleFactory = new SaleFactory;
        return $saleFactory->getSale(
            id: null,
            userId: auth()->user()->id,
            pointOfSaleId: null,
            nearPointOfSaleId: null,
            saleValues: $this->input('saleValue'),
            date: $this->input('date'),
            hour: $this->input('hour'),
            kmPointOfSaleMain: null,
            kmNearPointOfSale: null,
            latitude: $this->input('latitude'),
            longitude: $this->input('longitude'),
            isRoaming: null,
            createdAt: 'now',
            updatedAt: 'now'
        );
    }
}
