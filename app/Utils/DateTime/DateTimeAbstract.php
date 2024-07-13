<?php

declare(strict_types=1);

namespace App\Utils\DateTime;

use DateTime;
use JsonSerializable;

abstract class DateTimeAbstract implements JsonSerializable
{
    protected ?DateTime $datetime;

    public function __construct(
        string | null $date = "now",
        \DateTimeZone $timezone = null
    ) {
        $this->datetime = $date ? new DateTime($date) : null;
    }

    public function toDateBase(): ?string
    {
        return $this->dateTime()?->format('Y-m-d H:i:s');
    }

    public function toDate(): ?string
    {
        return $this->dateTime()?->format('Y-m-d');
    }

    public function jsonSerialize(): array
    {
        return $this->json();
    }

    protected function json(): array
    {
        return [
            'pt-br' => $this->dateTime()?->format('d/m/Y H:i:s'),
            'en-us' => $this->dateTime()?->format('Y-m-d H:i:s'),
        ];
    }

    protected function dateTime(): ?DateTime
    {
        return $this->datetime;
    }
}
