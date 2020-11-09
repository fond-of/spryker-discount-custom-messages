<?php


namespace FondOfSpryker\Zed\DiscountCustomMessages\Dependency\Facade;


use Codeception\Test\Unit;
use Generated\Shared\Transfer\MessageTransfer;
use Spryker\Zed\Messenger\Business\MessengerFacadeInterface;

class DiscountCustomMessageToMessengerFacadeBridgeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|MessengerFacadeInterface
     */
    protected $messengerFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\MessageTransfer
     */
    protected $messageTransferMock;

    /**
     * @var DiscountCustomMessageToMessengerFacadeInterface
     */
    protected $bridge;

    /**
     * @return void
     */
    protected function _before()
    {
        $this->messengerFacadeMock = $this->getMockBuilder(MessengerFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->messageTransferMock = $this->getMockBuilder(MessageTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->bridge = new DiscountCustomMessageToMessengerFacadeBridge($this->messengerFacadeMock);
    }

    /**
     * @return void
     */
    public function testAddErrorMessage(): void
    {
        $this->messengerFacadeMock->expects($this->once())
            ->method('addErrorMessage')
            ->willReturn($this->messageTransferMock);

        $this->bridge->addErrorMessage($this->messageTransferMock);
    }

    /**
     * @return void
     */
    public function testAddSuccessMessage(): void
    {
        $this->messengerFacadeMock->expects($this->once())
            ->method('addSuccessMessage')
            ->willReturn($this->messageTransferMock);

        $this->bridge->addSuccessMessage($this->messageTransferMock);
    }
}
