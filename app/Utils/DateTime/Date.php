<?php

namespace App\Utils\DateTime;

use DateTime;

trait Date
{
    public function now(string $format = 'Y-m-d'): string
    {
        return (new DateTime('now'))->format($format);
    }
}
