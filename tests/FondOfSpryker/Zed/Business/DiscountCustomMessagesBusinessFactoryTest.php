<?php

namespace FondOfSpryker\Zed\DiscountCustomMessages\Business;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\DiscountCustomMessages\Business\Model\DiscountCustomMessagesExpanderInterface;
use FondOfSpryker\Zed\DiscountCustomMessages\Business\Model\DiscountCustomMessagesReaderInterface;
use FondOfSpryker\Zed\DiscountCustomMessages\Business\Model\Mapper\DiscountCustomMessagesMapper;
use FondOfSpryker\Zed\DiscountCustomMessages\Business\Model\Mapper\DiscountCustomMessagesMapperInterface;
use FondOfSpryker\Zed\DiscountCustomMessages\Dependency\Facade\DiscountCustomMessageToLocaleFacadeBridge;
use FondOfSpryker\Zed\DiscountCustomMessages\Dependency\Facade\DiscountCustomMessageToLocaleFacadeInterface;
use FondOfSpryker\Zed\DiscountCustomMessages\DiscountCustomMessagesDependencyProvider;
use FondOfSpryker\Zed\DiscountCustomMessages\Persistence\DiscountCustomMessagesEntityManager;
use FondOfSpryker\Zed\DiscountCustomMessages\Persistence\DiscountCustomMessagesEntityManagerInterface;
use FondOfSpryker\Zed\DiscountCustomMessages\Persistence\DiscountCustomMessagesRepository;
use FondOfSpryker\Zed\DiscountCustomMessages\Persistence\DiscountCustomMessagesRepositoryInterface;
use Spryker\Zed\Kernel\Container;

class DiscountCustomMessagesBusinessFactoryTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\DiscountCustomMessages\Business\DiscountCustomMessagesBusinessFactory
     */
    protected $factory;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\DiscountCustomMessages\Dependency\Facade\DiscountCustomMessageToLocaleFacadeInterface
     */
    protected $localeFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|DiscountCustomMessagesRepositoryInterface
     */
    protected $repository;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|DiscountCustomMessagesEntityManagerInterface
     */
    protected $entityManager;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|DiscountCustomMessagesMapperInterface
     */
    protected $discountCustomMessagesMapperMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->localeFacadeMock = $this->getMockBuilder(DiscountCustomMessageToLocaleFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->repository = $this->getMockBuilder(DiscountCustomMessagesRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->entityManager = $this->getMockBuilder(DiscountCustomMessagesEntityManager::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->discountCustomMessagesMapperMock = $this->getMockBuilder(DiscountCustomMessagesMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factory = new DiscountCustomMessagesBusinessFactory();
        $this->factory->setContainer($this->containerMock);
        $this->factory->setRepository($this->repository);
        $this->factory->setEntityManager($this->entityManager);
    }

    /**
     * @return void
     */
    public function testCreateDiscountCustomMessagesExpander(): void
    {
        $this->containerMock->expects($this->once())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->withConsecutive([DiscountCustomMessagesDependencyProvider::FACADE_LOCALE])
            ->willReturnOnConsecutiveCalls($this->localeFacadeMock);

        $this->assertInstanceOf(
            DiscountCustomMessagesExpanderInterface::class,
            $this->factory->createDiscountCustomMessagesExpander()
        );
    }

    public function testCreateDiscountCustomMessagesMapper(): void
    {
        $this->containerMock->expects($this->once())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->withConsecutive([DiscountCustomMessagesDependencyProvider::FACADE_LOCALE])
            ->willReturnOnConsecutiveCalls($this->localeFacadeMock);

        $this->assertInstanceOf(
            DiscountCustomMessagesMapperInterface::class,
            $this->factory->createDiscountCustomMessagesMapper()
        );
    }

    /**
     * @return void
     */
    public function testCreateDiscountCustomMessagesReader(): void
    {
        /* @todo */
    }
}
