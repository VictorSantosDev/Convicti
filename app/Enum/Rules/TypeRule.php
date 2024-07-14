<?php

namespace App\Enum\Rules;

use ReflectionEnum;

enum TypeRule: string
{
    case SELLER = 'SELLER';
    case MANAGE = 'MANAGE';
    case BOARD = 'BOARD';
    case GENERAL_BOARD = 'GENERAL_BOARD';
}
