<?php

declare(strict_types=1);

namespace App\Http\Requests\Sale;

use App\Utils\Permission\CanAccess;
use Illuminate\Foundation\Http\FormRequest;

class ShowSaleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return CanAccess::check('show_sale');
    }
}
