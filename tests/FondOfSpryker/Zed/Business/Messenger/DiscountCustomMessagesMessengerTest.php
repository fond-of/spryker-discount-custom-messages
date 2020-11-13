<?php

namespace FondOfSpryker\Zed\DiscountCustomMessages\Business\Messenger;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\DiscountCustomMessages\Business\Model\DiscountCustomMessagesReaderInterface;
use FondOfSpryker\Zed\DiscountCustomMessages\Dependency\Facade\DiscountCustomMessageToMessengerFacadeInterface;
use FondOfSpryker\Zed\DiscountCustomMessages\DiscountCustomMessagesConfig;
use Generated\Shared\Transfer\DiscountCustomMessageTransfer;
use Generated\Shared\Transfer\DiscountTransfer;

class DiscountCustomMessagesMessengerTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\DiscountCustomMessages\Dependency\Facade\DiscountCustomMessageToMessengerFacadeInterface
     */
    protected $messengerFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\DiscountCustomMessages\Business\Model\DiscountCustomMessagesReaderInterface
     */
    protected $customMessagesReaderMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\DiscountCustomMessages\DiscountCustomMessagesConfig
     */
    protected $customMessagesConfigMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\DiscountTransfer
     */
    protected $discountTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\DiscountCustomMessageTransfer
     */
    protected $discountCustomMessagesTransferMock;

    /**
     * @var DiscountCustomMessagesMessengerInterface
     */
    protected $discountCustomMessagesMessenger;

    /**
     * @return void
     */
    protected function _before()
    {
        $this->discountCustomMessagesTransferMock = $this->getMockBuilder(DiscountCustomMessageTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customMessagesReaderMock = $this->getMockBuilder(DiscountCustomMessagesReaderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->messengerFacadeMock = $this->getMockBuilder(DiscountCustomMessageToMessengerFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customMessagesConfigMock = $this->getMockBuilder(DiscountCustomMessagesConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->discountTransferMock = $this->getMockBuilder(DiscountTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->discountCustomMessagesMessenger = new DiscountCustomMessagesMessenger(
            $this->customMessagesReaderMock,
            $this->messengerFacadeMock,
            $this->customMessagesConfigMock
        );
    }

    /**
     * @return void
     */
    public function testAddSuccessMessageWithCustomMessage(): void
    {
        $this->customMessagesReaderMock->expects($this->once())
            ->method('findCustomMessageByIdDiscountAndCurrentLocale')
            ->with($this->discountTransferMock)
            ->willReturn($this->discountCustomMessagesTransferMock);

        $this->discountCustomMessagesTransferMock->expects($this->exactly(2))
            ->method('getSuccessMessage')
            ->willReturn('success');

        $this->messengerFacadeMock->expects($this->once())
            ->method('addSuccessMessage');

        $this->discountCustomMessagesMessenger->addSuccessMessageFromDiscountTransfer($this->discountTransferMock);
    }

    /**
     * @return void
     */
    public function testAddSuccessMessageWithDefaultMessage(): void
    {
        $this->customMessagesReaderMock->expects($this->once())
            ->method('findCustomMessageByIdDiscountAndCurrentLocale')
            ->with($this->discountTransferMock)
            ->willReturn(null);

        $this->customMessagesConfigMock->expects($this->once())
            ->method('getDefaultSuccessMessage')
            ->willReturn('success');

        $this->discountCustomMessagesMessenger->addSuccessMessageFromDiscountTransfer($this->discountTransferMock);
    }

    /**
     * @return void
     */
    public function testAddErrorMessageWithCustomMessage(): void
    {
        $this->customMessagesReaderMock->expects($this->once())
            ->method('findCustomMessageByIdDiscountAndCurrentLocale')
            ->with($this->discountTransferMock)
            ->willReturn($this->discountCustomMessagesTransferMock);

        $this->discountCustomMessagesTransferMock->expects($this->exactly(2))
            ->method('getErrorMessage')
            ->willReturn('error');

        $this->messengerFacadeMock->expects($this->once())
            ->method('addErrorMessage');

        $this->discountCustomMessagesMessenger->addErrorMessageFromDiscountTransfer($this->discountTransferMock);
    }

    /**
     * @return void
     */
    public function testAddErrorMessageWithDefaultMessage(): void
    {
        $this->customMessagesReaderMock->expects($this->once())
            ->method('findCustomMessageByIdDiscountAndCurrentLocale')
            ->with($this->discountTransferMock)
            ->willReturn(null);

        $this->customMessagesConfigMock->expects($this->once())
            ->method('getDefaultErrorMessage')
            ->willReturn('error');

        $this->discountCustomMessagesMessenger->addErrorMessageFromDiscountTransfer($this->discountTransferMock);
    }
}
