<?php

namespace FondOfSpryker\Zed\DiscountCustomMessages\Business\Model;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\DiscountCustomMessages\Dependency\Facade\DiscountCustomMessageToLocaleFacadeInterface;
use FondOfSpryker\Zed\DiscountCustomMessages\Persistence\DiscountCustomMessagesRepository;
use Generated\Shared\Transfer\DiscountConfiguratorTransfer;
use Generated\Shared\Transfer\DiscountCustomMessageTransfer;
use Generated\Shared\Transfer\DiscountTransfer;
use Generated\Shared\Transfer\LocaleTransfer;

class DiscountCustomMessagesReaderTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\DiscountCustomMessages\Persistence\DiscountCustomMessagesRepositoryInterface
     */
    protected $repository;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\DiscountCustomMessages\Dependency\Facade\DiscountCustomMessageToLocaleFacadeInterface
     */
    protected $localeFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\DiscountConfiguratorTransfer
     */
    protected $discountConfiguratorTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\DiscountTransfer
     */
    protected $discountTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\DiscountCustomMessageTransfer
     */
    protected $discountCustomMessagesTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\LocaleTransfer
     */
    protected $localeTransferMock;

    /**
     * @var DiscountCustomMessagesReader
     */
    protected $reader;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->repository = $this->getMockBuilder(DiscountCustomMessagesRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->localeFacadeMock = $this->getMockBuilder(DiscountCustomMessageToLocaleFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->discountConfiguratorTransferMock = $this->getMockBuilder(DiscountConfiguratorTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->discountCustomMessagesTransferMock = $this->getMockBuilder(DiscountCustomMessageTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->localeTransferMock = $this->getMockBuilder(LocaleTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->discountTransferMock = $this->getMockBuilder(DiscountTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->reader = new DiscountCustomMessagesReader($this->repository, $this->localeFacadeMock);
    }

    /**
     * @return void
     */
    public function testExpandDiscountCustomMessages(): void
    {
        $discountCustomMessageTransferCollection = include codecept_data_dir('DiscountCustomMessageTransferCollection.php');

        $this->discountConfiguratorTransferMock->expects($this->once())
            ->method('getDiscountGeneral')
            ->willReturn($this->discountTransferMock);

        $this->discountTransferMock->expects($this->once())
            ->method('getIdDiscount')
            ->willReturn(1);

        $this->discountConfiguratorTransferMock->expects($this->atLeastOnce())
            ->method('addDiscountCustomMessages');

        $reader = $this->getMockBuilder(DiscountCustomMessagesReader::class)
            ->disableOriginalConstructor()
            ->setMethods(['findDiscountCustomMessagesByIdDiscount'])
            ->getMock();

        $reader->expects($this->once())
            ->method('findDiscountCustomMessagesByIdDiscount')
            ->willReturn($discountCustomMessageTransferCollection);

        $reader->expandDiscountCustomMessages($this->discountConfiguratorTransferMock);
    }

    /**
     * @return void
     */
    public function testFindCustomMessageByIdDiscountAndCurrentLocaleSuccess(): void
    {
        $this->discountTransferMock->expects($this->atLeastOnce())
            ->method('getIdDiscount')
            ->willReturn(1);

        $this->localeFacadeMock->expects($this->atLeastOnce())
            ->method('getCurrentLocale')
            ->willReturn($this->localeTransferMock);

        $this->localeTransferMock->expects($this->atLeastOnce())
            ->method('getIdLocale')
            ->willReturn(1);

        $this->repository->expects($this->atLeastOnce())
            ->method('findDiscountCustomMessageByIdDiscountAndIdLocale')
            ->willReturn($this->discountCustomMessagesTransferMock);

        $discountCustomMessagesTransfer = $this->reader->findCustomMessageByIdDiscountAndCurrentLocale(
            $this->discountTransferMock
        );

        $this->assertInstanceOf(DiscountCustomMessageTransfer::class, $discountCustomMessagesTransfer);
    }
}
