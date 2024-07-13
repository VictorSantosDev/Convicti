<?php

declare(strict_types=1);

namespace App\Domain\User\Entity;

use App\Utils\DateTime\CreatedAt;
use App\Utils\DateTime\UpdatedAt;
use App\ValuesObjects\Id;
use JsonSerializable;

class User implements JsonSerializable
{
    public function __construct(
        private Id $id,
        private Id $ruleId,
        private Id $pointOfSaleId,
        private string $name,
        private string $email,
        private CreatedAt $emailVerifiedAt,
        private string $password,
        private ?string $rememberToken,
        private CreatedAt $createdAt,
        private UpdatedAt $updatedAt
    ) {}

    public function getId(): Id
    {
        return $this->id;
    }

    public function getRuleId(): Id
    {
        return $this->ruleId;
    }

    public function getPointOfSaleId(): Id
    {
        return $this->pointOfSaleId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getEmailVerifiedAt(): CreatedAt
    {
        return $this->emailVerifiedAt;
    }

    public function getPassword(): string
    {
        return $this->rememberToken;
    }

    public function getRememberToken(): ?string
    {
        return $this->rememberToken;
    }

    public function getCreatedAt(): CreatedAt
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): UpdatedAt
    {
        return $this->updatedAt;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->getId()->get(),
            'ruleId' => $this->getRuleId()->get(),
            'pointOfSaleId' => $this->getPointOfSaleId()->get(),
            'name' => $this->getName(),
            'email' => $this->getEmail(),
            'emailVerifiedAt' => $this->getEmailVerifiedAt()->toDateBase(),
            'rememberToken' => $this->getRememberToken(),
            'createdAt' => $this->getCreatedAt()->toDateBase(),
            'updatedAt' => $this->getUpdatedAt()->toDateBase(),
        ];
    }
}
