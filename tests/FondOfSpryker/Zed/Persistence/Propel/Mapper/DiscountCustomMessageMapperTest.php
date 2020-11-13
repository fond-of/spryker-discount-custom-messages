<?php

namespace FondOfSpryker\Zed\DiscountCustomMessages\Persistence\Propel\Mapper;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\DiscountCustomMessageTransfer;
use Generated\Shared\Transfer\LocaleTransfer;
use Orm\Zed\DiscountDiscountMessage\Persistence\FobDiscountCustomMessage;
use function Symfony\Component\DependencyInjection\Loader\Configurator\expr;

class DiscountCustomMessageMapperTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|DiscountCustomMessageTransfer
     */
    protected $discountCustomMessageTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|FobDiscountCustomMessage
     */
    protected $discountCustomMessageEntityMock;

    /**
     * @var DiscountCustomMessageMapperInterface
     */
    protected $discountCustomMessageMapper;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|LocaleTransfer
     */
    protected $localeTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->discountCustomMessageTransferMock = $this->getMockBuilder(DiscountCustomMessageTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->discountCustomMessageEntityMock = $this->getMockBuilder(FobDiscountCustomMessage::class)
            ->disableOriginalConstructor()
            ->setMethods(['fromArray', 'toArray', 'setFkLocale', 'setFkDiscount', 'getLocale'])
            ->getMockForAbstractClass();

        $this->localeTransferMock = $this->getMockBuilder(LocaleTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->discountCustomMessageMapper = new DiscountCustomMessageMapper();
    }

    /**
     * @return void
     */
    public function testMapTransferToEntity(): void
    {
        $this->discountCustomMessageEntityMock->expects($this->once())
            ->method('fromArray')
            ->with($this->discountCustomMessageTransferMock->toArray())
            ->willReturn([]);

        $this->discountCustomMessageEntityMock->expects($this->once())
            ->method('setFkLocale')
            ->with(1)
            ->willReturnSelf();

        $this->discountCustomMessageEntityMock->expects($this->once())
            ->method('setFkDiscount')
            ->with(1)
            ->willReturnSelf();

        $this->discountCustomMessageTransferMock->expects($this->once())
            ->method('getLocale')
            ->willReturn($this->localeTransferMock);

        $this->discountCustomMessageTransferMock->expects($this->once())
            ->method('getIdDiscount')
            ->willReturn(1);

        $this->localeTransferMock->expects($this->once())
            ->method('getIdLocale')
            ->willReturn(1);

        $this->discountCustomMessageMapper->mapTransferToEntity(
            $this->discountCustomMessageTransferMock,
            $this->discountCustomMessageEntityMock
        );
    }

    /**
     * @return void
     */
    public function testMapEntityToTransfer(): void
    {
        $this->discountCustomMessageEntityMock->expects($this->atLeastOnce())
            ->method('toArray')
            ->willReturn($this->discountCustomMessageEntityMock->toArray());

        /*$this->discountCustomMessageEntityMock->expects($this->once())
            ->method('getLocale')
            ->willReturn($this->localeTransferMock);

        $this->localeTransferMock->expects($this->atLeastOnce())
            ->method('toArray')
            ->willReturn($this->localeTransferMock->toArray());*/

        $this->discountCustomMessageMapper->mapEntityToTransfer(
            $this->discountCustomMessageEntityMock,
            $this->discountCustomMessageTransferMock
        );
    }
}
