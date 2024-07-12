<?php

declare(strict_types=1);

namespace App\ModelRoute\Meter;

class Distance
{
    static public function calculate(
        string $latitudeTo,
        string $longitudeTo,
        string $latitudeFrom,
        string $longitudeFrom
    ): string {
        $latitudeTo = static::convertRadians($latitudeTo);
        $latitudeFrom = static::convertRadians($latitudeFrom);
        $longitudeTo = static::convertRadians($longitudeTo);
        $longitudeFrom = static::convertRadians($longitudeFrom);

        $latDifference = $latitudeFrom - $latitudeTo;
        $lonDifference = $longitudeFrom - $longitudeTo;

        $distance = 2 * asin(sqrt(pow(sin($latDifference / 2), 2) +
        cos($latitudeTo) * cos($latitudeFrom) * pow(sin($lonDifference / 2), 2)));

        $distance *= 6371;

        return number_format($distance, 2, '.', '');
    }

    static private function convertRadians(string $latOrLon): float
    {
        return deg2rad(floatval($latOrLon));
    } 
}
