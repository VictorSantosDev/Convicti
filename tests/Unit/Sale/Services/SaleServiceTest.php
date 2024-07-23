<?php

namespace Tests\Unit\Sale\Services;

use App\Domain\Board\Services\BoardService;
use App\Domain\PointOfSale\Entity\PointOfSale;
use App\Domain\PointOfSale\Factories\Factory\PointOfSaleFactory;
use App\Domain\PointOfSale\Infrastructure\Repository\PointOfSaleRepositoryInterface;
use App\Domain\PointOfSale\Services\PointOfSaleService;
use App\Domain\Route\Services\RouteService;
use App\Domain\Rules\Entity\Rule;
use App\Domain\Rules\Services\RulesServices;
use App\Domain\Sale\Entity\Sale;
use App\Domain\Sale\Factories\Factory\SaleFactory;
use App\Domain\Sale\Infrastructure\Entity\SaleEntityInterface;
use App\Domain\Sale\Infrastructure\Repository\SaleRepositoryInterface;
use App\Domain\Sale\Services\SaleService;
use App\Enum\Rules\TypeRule;
use App\ModelRoute\Composite\Entity\RouteIdentifier;
use App\Utils\DateTime\CreatedAt;
use App\Utils\DateTime\UpdatedAt;
use App\ValuesObjects\Id;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class SaleServiceTest extends TestCase
{
    private BoardService | MockObject $boardServiceMock;
    private RulesServices | MockObject $rulesServicesMock;
    private RouteService | MockObject $routeServicesMock;
    private RulesServices | MockObject $rulesServices;
    private PointOfSaleRepositoryInterface | MockObject $pointOfSaleRepositoryMock;
    private SaleRepositoryInterface | MockObject $saleRepository;
    private SaleEntityInterface | MockObject $saleEntityMock;
    private RulesServices | MockObject $rulesServiceMock;
    private RouteService | MockObject $routeServiceMock;
    private SaleRepositoryInterface | MockObject $saleRepositoryMock;

    public function setUp(): void
    {
        $this->boardServiceMock = $this->createMock(BoardService::class);
        $this->rulesServicesMock = $this->createMock(RulesServices::class);
        $this->routeServicesMock = $this->createMock(RouteService::class);
        $this->rulesServices = $this->createMock(RulesServices::class);
        $this->pointOfSaleRepositoryMock = $this->createMock(PointOfSaleRepositoryInterface::class);
        $this->saleRepository = $this->createMock(SaleRepositoryInterface::class);
        $this->saleEntityMock = $this->createMock(SaleEntityInterface::class);
        $this->rulesServiceMock = $this->createMock(RulesServices::class);
        $this->routeServiceMock = $this->createMock(RouteService::class);
        $this->saleRepositoryMock = $this->createMock(SaleRepositoryInterface::class);
    }

    public function testShouldCreateSaleWithSuccess(): void
    {   
        $this->pointOfSaleRepositoryMock->method('getAllPointOfSales')
        ->willReturn([$this->getPointOfSale()]);

        $this->pointOfSaleRepositoryMock->method('findById')
        ->willReturn($this->getPointOfSale());

        $pointOfSaleService = new PointOfSaleService(
            $this->pointOfSaleRepositoryMock,
            $this->boardServiceMock,
            $this->rulesServicesMock
        );

        $this->routeServicesMock
        ->method('nearRouteByPointOfSale')
        ->willReturn(new RouteIdentifier(
            identifier: Id::set(1),
            latitude: '-19.871568',
            longitude: '-43.976538'
        ));

        $this->saleEntityMock
        ->method('create')
        ->willReturn(new Sale(
            id: Id::set(1),
            userId: Id::set(1),
            pointOfSaleId: Id::set(1),
            nearPointOfSaleId: Id::set(null),
            saleValues: '2500',
            kmNearPointOfSale: null,
            latitude: '-19.871568',
            longitude: '-19.871568',
            isRoaming: false,
            createdAt: new CreatedAt(),
            updatedAt: new UpdatedAt()
        ));

        $saleService = new SaleService(
            $pointOfSaleService,
            $this->routeServicesMock,
            $this->saleEntityMock,
            $this->saleRepository,
            $this->rulesServices
        );

        $output = $saleService->create($this->getSale());

        $this->assertEquals(1, $output->getId()->get());
        $this->assertEquals(1, $output->getUserId()->get());
        $this->assertEquals(1, $output->getPointOfSaleId()->get());
        $this->assertEquals(null, $output->getNearPointOfSaleId()->get());
        $this->assertEquals('2500', $output->getSaleValues());
        $this->assertEquals(null, $output->getKmNearPointOfSale());
        $this->assertEquals('-19.871568', $output->getLatitude());
        $this->assertEquals('-19.871568', $output->getLongitude());
        $this->assertEquals(false, $output->getIsRoaming());
    }

    public function testShouldReturnOneSaleWithSuccess(): void
    {
        $this->pointOfSaleRepositoryMock->method('findById')
        ->willReturn($this->getPointOfSale());

        $this->pointOfSaleRepositoryMock->method('findByIdTryFrom')->willReturn(null);

        $this->rulesServiceMock->method('findByRule')->willReturn(new Rule(
            id: Id::set(1),
            type: TypeRule::SELLER,
            created_at: new CreatedAt(),
            updated_at: new UpdatedAt()
        ));

        $this->saleRepositoryMock->method('findByIdByUserId')->willReturn($this->getSale());

        $pointOfSaleService = new PointOfSaleService(
            $this->pointOfSaleRepositoryMock,
            $this->boardServiceMock,
            $this->rulesServiceMock
        );

        $saleService = new SaleService(
            $pointOfSaleService,
            $this->routeServiceMock,
            $this->saleEntityMock,
            $this->saleRepositoryMock,
            $this->rulesServiceMock
        );

        $output = $saleService->show(1, 1, 1);

        $this->assertArrayHasKey('sale', $output);
        $this->assertArrayHasKey('pointOfSaleMain', $output);
        $this->assertArrayHasKey('pointOfSaleNear', $output);
        $this->assertEquals(null, $output['pointOfSaleNear']);
    }

    private function getPointOfSale(): PointOfSale
    {
        $pointOfSaleFactory = new PointOfSaleFactory;
        return $pointOfSaleFactory->getPointOfSale(
            1,
            2,
            'Teste Empresa',
            '-19.871568',
            '-43.976538',
            'now',
            'now'
        );
    }

    private function getSale(): Sale
    {
        $saleFactory = new SaleFactory;
        return $saleFactory->getSale(
            id: null,
            userId: 1,
            pointOfSaleId: 1,
            nearPointOfSaleId: 1,
            saleValues: '2500',
            kmNearPointOfSale: null,
            latitude: '-19.871568',
            longitude: '-19.871568',
            isRoaming: false,
            createdAt:  'now',
            updatedAt:  'now'
        );
    }
}
