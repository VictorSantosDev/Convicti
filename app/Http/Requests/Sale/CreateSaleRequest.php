<?php

declare(strict_types=1);

namespace App\Http\Requests\Sale;

use App\Domain\Sale\Entity\Sale;
use App\Domain\Sale\Factories\Factory\SaleFactory;
use App\Utils\Permission\CanAccess;
use Closure;
use Illuminate\Foundation\Http\FormRequest;

class CreateSaleRequest extends FormRequest
{
    const REGEX_HOUR = "/^(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/";

    public function authorize(): bool
    {
        return CanAccess::check('create_sale');
    }

    public function rules(): array
    {
        return [
            'saleValue' => 'required|numeric|string|max_digits:10|min:1',
            'latitude' => 'required|string',
            'longitude' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'O campo :attribute é obrigatório',
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
            pointOfSaleId: auth()->user()->point_of_sale_id,
            nearPointOfSaleId: null,
            saleValues: $this->input('saleValue'),
            kmNearPointOfSale: null,
            latitude: $this->input('latitude'),
            longitude: $this->input('longitude'),
            isRoaming: false,
            createdAt: 'now',
            updatedAt: 'now'
        );
    }
}
