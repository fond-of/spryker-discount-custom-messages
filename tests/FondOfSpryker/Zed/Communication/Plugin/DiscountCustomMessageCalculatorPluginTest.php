<?php

namespace FondOfSpryker\Zed\DiscountCustomMessages\Communication\Plugin;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\DiscountCustomMessages\Communication\DiscountCustomMessagesCommunicationFactory;
use Generated\Shared\Transfer\DiscountTransfer;

class DiscountCustomMessageCalculatorPluginTest extends Unit
{
    /**
     * @var DiscountCustomMessageCalculatorPlugin
     */
    protected $plugin;

    /**
     * @var \Generated\Shared\Transfer\DiscountTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $discountTransferMock;

    /**
     * @var \FondOfSpryker\Zed\DiscountCustomMessages\Communication\DiscountCustomMessagesCommunicationFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $factoryMock;

    /**
     * @retun void
     *
     * @return void
     */
    protected function _before(): void
    {
        $this->plugin = new DiscountCustomMessageCalculatorPlugin();
        $this->discountTransferMock = $this->getMockBuilder(DiscountTransfer::class)->getMock();
        $this->factoryMock = $this->getMockBuilder(DiscountCustomMessagesCommunicationFactory::class)->getMock();
    }

    /**
     * @retun void
     *
     * @return void
     */
    public function addSuccessMessageTest(): void
    {
        $this->factoryMock->expects($this->once())
            ->method('addSuccessMessage')
            ->with($this->discountTransferMock);

        $this->plugin->addSuccessMessage($this->discountTransferMock);
    }

    /**
     * @retun void
     *
     * @return void
     */
    public function addErrorMessageTest(): void
    {
        $this->factoryMock->expects($this->once())
            ->method('addErrorMessage')
            ->with($this->discountTransferMock);

        $this->plugin->addErrorMessage($this->discountTransferMock);
    }
}
