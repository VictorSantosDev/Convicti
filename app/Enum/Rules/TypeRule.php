<?php

namespace App\Enum\Rules;

enum TypeRule: string
{
    case SELLER = 'SELLER';
    case MANAGE = 'MANAGE';
    case BOARD = 'BOARD';
    case GENERAL_BOARD = 'GENERAL_BOARD';
}
