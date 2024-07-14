<?php

namespace App\Enum\Rules;

use ReflectionEnum;

enum TypeRule: string
{
    case SELLER = 'SELLER';
    case MANAGE = 'MANAGE';
    case BOARD = 'BOARD';
    case GENERAL_BOARD = 'GENERAL_BOARD';

    static public function getEnum(): array
    {
        return array_values(array_map(fn ($value) => $value->value,(new ReflectionEnum(get_class()))->getConstants()));
    }
}
