<?php

namespace App\Domain\Sale\Services;

use App\Domain\PointOfSale\Entity\PointOfSale;
use App\Domain\PointOfSale\Services\PointOfSaleService;
use App\Domain\Route\Services\RouteService;
use App\Domain\Rules\Services\RulesServices;
use App\Domain\Sale\Entity\Sale;
use App\Domain\Sale\Factories\Factory\SaleFactory;
use App\Domain\Sale\Infrastructure\Entity\SaleEntityInterface;
use App\Domain\Sale\Infrastructure\Repository\SaleRepositoryInterface;
use App\Enum\Rules\TypeRule;
use App\ModelRoute\Composite\Entity\RouteIdentifier;
use App\ValuesObjects\Id;

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

    public function show(int $id): array
    {
        $user = auth()->user();

        $rule = $this->rulesServices->findByRule(Id::set($user->rule_id));

        $sale = $this->saleRepository->findByIdByUserId(
            Id::set($id), 
            Id::set($user->id),
            TypeRule::tryFrom($rule->getType()->value)
        );

        $pointOfSale = $this->pointOfSaleService->findById($sale->getPointOfSaleId());

        return [
            'sale' => $sale->jsonSerialize(),
            'pointOfSale' => $pointOfSale->jsonSerialize()
        ];
    }

    public function list(array $filter): array
    {
        $user = auth()->user();
        $rule = $this->rulesServices->findByRule(Id::set($user->rule_id));

        $salesCollection = $this->saleRepository->findAllWithFilter(
            $filter['dateInitial'],
            $filter['dateFinal'],
            Id::set($filter['userId']),
            Id::set($filter['pointOfSaleId']),
            Id::set($filter['boardId']),
            TypeRule::tryFrom($rule->getType()->value)
        );

        dd($salesCollection);
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
    public function saleMount(array $pointOfSalesCollection, Sale $sale): Sale
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
            date: $sale->getDate()->toDate(),
            hour: $sale->getHour(),
            kmNearPointOfSale: $kmNearPointOfSale,
            latitude: $sale->getLatitude(),
            longitude: $sale->getLongitude(),
            isRoaming: $isRoaming,
            createdAt: $sale->getCreatedAt()->toDateBase(),
            updatedAt: $sale->getUpdatedAt()->toDateBase()
        );
    }
}
