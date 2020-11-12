<?php

namespace FondOfSpryker\Zed\DiscountCustomMessages\Business\Model;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\DiscountCustomMessages\Dependency\Facade\DiscountCustomMessageToLocaleFacadeInterface;
use FondOfSpryker\Zed\DiscountCustomMessages\Persistence\DiscountCustomMessagesEntityManagerInterface;
use Generated\Shared\Transfer\DiscountConfiguratorTransfer;
use Generated\Shared\Transfer\DiscountTransfer;

class DiscountCustomMessagesWriterTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\DiscountCustomMessages\Dependency\Facade\DiscountCustomMessageToLocaleFacadeInterface
     */
    protected $localeFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\DiscountCustomMessages\Persistence\DiscountCustomMessagesEntityManagerInterface
     */
    protected $entityManager;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\DiscountConfiguratorTransfer
     */
    protected $discountConfiguratorTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\DiscountTransfer
     */
    protected $discountTransferMock;

    /**
     * @var DiscountCustomMessagesWriterInterface
     */
    protected $writer;

    /**
     * @return void
     */
    protected function _before()
    {
        $this->localeFacadeMock = $this->getMockBuilder(DiscountCustomMessageToLocaleFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->entityManager = $this->getMockBuilder(DiscountCustomMessagesEntityManagerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->discountConfiguratorTransferMock = $this->getMockBuilder(DiscountConfiguratorTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->discountTransferMock = $this->getMockBuilder(DiscountTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->writer = new DiscountCustomMessagesWriter($this->entityManager, $this->localeFacadeMock);
    }

    /**
     * @return void
     */
    public function testCreateByDiscountConfiguratorTransfer(): void
    {
        $discountCustomMessageTransferCollection = include codecept_data_dir('DiscountCustomMessageTransferCollection.php');

        $this->discountConfiguratorTransferMock->expects($this->once())
            ->method('getDiscountCustomMessages')
            ->willReturn($discountCustomMessageTransferCollection);

        $this->discountTransferMock->expects($this->atLeastOnce())
            ->method('getIdDiscount')
            ->willReturn(1);

        $this->discountConfiguratorTransferMock->expects($this->atLeastOnce())
            ->method('getDiscountGeneral')
            ->willReturn($this->discountTransferMock);

        $this->entityManager->expects($this->atLeastOnce())
            ->method('create');

        $this->writer->createByDiscountConfiguratorTransfer($this->discountConfiguratorTransferMock);
    }

    /**
     * @return void
     */
    public function testUpdate(): void
    {
        $discountCustomMessageTransferCollection = include codecept_data_dir('DiscountCustomMessageTransferCollection.php');

        $this->discountConfiguratorTransferMock->expects($this->once())
            ->method('getDiscountCustomMessages')
            ->willReturn($discountCustomMessageTransferCollection);

        $this->entityManager->expects($this->atLeastOnce())
            ->method('update');

        $this->writer->update($this->discountConfiguratorTransferMock);
    }
}
