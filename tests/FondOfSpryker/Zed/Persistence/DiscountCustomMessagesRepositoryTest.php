<?php


namespace FondOfSpryker\Zed\DiscountCustomMessages\Persistence;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\DiscountCustomMessages\Persistence\Propel\Mapper\DiscountCustomMessageMapper;
use FondOfSpryker\Zed\DiscountCustomMessages\Persistence\Propel\Mapper\DiscountCustomMessageMapperInterface;
use Orm\Zed\DiscountDiscountMessage\Persistence\FobDiscountCustomMessageQuery;

class DiscountCustomMessagesRepositoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|DiscountCustomMessageMapperInterface
     */
    protected $discountCustomMessageMapperMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|FobDiscountCustomMessageQuery
     */
    protected $discountCustomMessageQueryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|DiscountCustomMessagesPersistenceFactory
     */
    protected $factoryMock;

    /**
     * @var DiscountCustomMessagesRepository
     */
    protected $repository;

    protected function _before(): void
    {
        $this->discountCustomMessageMapperMock = $this->getMockBuilder(DiscountCustomMessageMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->discountCustomMessageQueryMock = $this->getMockBuilder(FobDiscountCustomMessageQuery::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factoryMock = $this->getMockBuilder(DiscountCustomMessagesPersistenceFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->repository = new DiscountCustomMessagesRepository();
        $this->repository->setFactory($this->factoryMock);
    }
}
