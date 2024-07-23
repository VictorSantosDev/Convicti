<?php

namespace App\Domain\Sale\Services;

use App\Domain\PointOfSale\Entity\PointOfSale;
use App\Domain\PointOfSale\Services\PointOfSaleService;
use App\Domain\Route\Services\RouteService;
use App\Domain\Rules\Entity\Rule;
use App\Domain\Rules\Services\RulesServices;
use App\Domain\Sale\Entity\Sale;
use App\Domain\Sale\Factories\Factory\SaleFactory;
use App\Domain\Sale\Infrastructure\Entity\SaleEntityInterface;
use App\Domain\Sale\Infrastructure\Repository\SaleRepositoryInterface;
use App\Enum\Rules\TypeRule;
use App\ModelRoute\Composite\Entity\RouteIdentifier;
use App\ValuesObjects\Id;
use Exception;

class SaleService
{
    public function __construct(
        private PointOfSaleService $pointOfSaleService,
        private RouteService $routeServices,
        private SaleEntityInterface $saleEntity,
        private SaleRepositoryInterface $saleRepository,
        private RulesServices $rulesServices
    ) {}

    public function create(Sale $sale): Sale
    {
        $pointOfSalesCollection = $this->pointOfSaleService->getAllPointOfSales();
        $saleMounted = $this->saleMount($pointOfSalesCollection, $sale);
        return $this->saleEntity->create($saleMounted);
    }

    public function show(int $id, int $userId, int $ruleId): array
    {
        $rule = $this->rulesServices->findByRule(Id::set($ruleId));

        $sale = $this->saleRepository->findByIdByUserId(
            Id::set($id), 
            Id::set($userId),
            TypeRule::tryFrom($rule->getType()->value)
        );

        $pointOfSaleMain = $this->pointOfSaleService->findById($sale->getPointOfSaleId());
        $pointOfSaleNear = $this->pointOfSaleService->findByIdTryFrom($sale->getNearPointOfSaleId());

        return [
            'sale' => $sale->jsonSerialize(),
            'pointOfSaleMain' => $pointOfSaleMain->jsonSerialize(),
            'pointOfSaleNear' => $pointOfSaleNear?->jsonSerialize()
        ];
    }

    public function list(array $filter): array
    {
        $user = auth()->user();
        $rule = $this->rulesServices->findByRule(Id::set($user->rule_id));

        $this->validateToList($user, $filter, $rule);

        $salesCollection = $this->saleRepository->findAllWithFilter(
            $filter['dateInitial'],
            $filter['dateFinal'],
            Id::set($filter['userId'] ?? null),
            Id::set($filter['pointOfSaleId'] ?? null),
            Id::set($filter['boardId'] ?? null),
            $rule->getType()
        );

        return $salesCollection;
    }

    private function validateToList(
        \App\Models\User $user,
        array $filter,
        Rule $rule
    ): void {
        if (TypeRule::SELLER->value === $rule->getType()->value) {
            if (($filter['userId'] ?? null) != $user->id) 
                throw new Exception('Venda não pertence a esse usuário ou identificador não relacionado');
        }
    }

    /** @param PointOfSale[] $pointOfSalesCollection */
    private function handleNearPointOfSale(
        array $pointOfSalesCollection,
        string $latitude,
        string $longitude
    ): RouteIdentifier {
        return $this->routeServices->nearRouteByPointOfSale(
            $pointOfSalesCollection,
            $latitude,
            $longitude
        );
    }

    /** @param PointOfSale[] $pointOfSalesCollection */
    private function saleMount(array $pointOfSalesCollection, Sale $sale): Sale
    {
        $isRoaming = false;
        $nearPointOfSaleId = null;
        $kmNearPointOfSale = null;

        $pointOfSale = $this->pointOfSaleService->findById($sale->getPointOfSaleId());

        $nearPointOfSale = $this->handleNearPointOfSale(
            $pointOfSalesCollection,
            $sale->getLatitude(),
            $sale->getLongitude()
        );

        if ($pointOfSale->getId()->get() !== $nearPointOfSale->getIdentifier()->get()) {
            $isRoaming = true;
            $nearPointOfSaleId = $nearPointOfSale->getIdentifier()->get();
            $kmNearPointOfSale = $nearPointOfSale->getDistanceByPoint();
        }

        $saleFactory = new SaleFactory;

        return $saleFactory->getSale(
            id: null,
            userId: $sale->getUserId()->get(),
            pointOfSaleId: $sale->getPointOfSaleId()->get(),
            nearPointOfSaleId: $nearPointOfSaleId,
            saleValues: $sale->getSaleValues(),
            kmNearPointOfSale: $kmNearPointOfSale,
            latitude: $sale->getLatitude(),
            longitude: $sale->getLongitude(),
            isRoaming: $isRoaming,
            createdAt: $sale->getCreatedAt()->toDateBase(),
            updatedAt: $sale->getUpdatedAt()->toDateBase()
        );
    }
}
