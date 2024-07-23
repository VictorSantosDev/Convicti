<?php

declare(strict_types=1);

namespace App\Domain\PointOfSale\Services;

use App\Domain\Board\Services\BoardService;
use App\Domain\PointOfSale\Entity\PointOfSale;
use App\Domain\PointOfSale\Infrastructure\Repository\PointOfSaleRepositoryInterface;
use App\Domain\Rules\Services\RulesServices;
use App\Enum\Rules\TypeRule;
use App\ValuesObjects\Id;

class PointOfSaleService
{
    public function __construct(
        private PointOfSaleRepositoryInterface $pointOfSaleRepository,
        private BoardService $boardService,
        private RulesServices $rulesServices
    ) {}

    /** @return PointOfSale[] */
    public function getAllPointOfSales(): array
    {
        return $this->pointOfSaleRepository->getAllPointOfSales();
    }

    public function findById(Id $id): PointOfSale
    {
        return $this->pointOfSaleRepository->findById($id);
    }

    public function findByIdTryFrom(Id $id): ?PointOfSale
    {
        return $this->pointOfSaleRepository->findByIdTryFrom($id);
    }

    public function list(?string $name, int $limit): array
    {
        $user = auth()->user();
        $rule = $this->rulesServices->findByRule(Id::set($user->rule_id));
        $board = $this->boardService->findByIdUserTryFrom(Id::set($user->id));

        if (TypeRule::BOARD->value === $rule->getType()->value) {
            return $this->pointOfSaleRepository->findAllWithFilterRelatedBoardId(
                Id::set($board?->getId()->get()),
                $name,
                $limit
            );
        }

        if (TypeRule::GENERAL_BOARD->value === $rule->getType()->value) {
            return $this->pointOfSaleRepository->findAllWithFilter(
                $name,
                $limit
            );
        }

        return [];
    }
}
