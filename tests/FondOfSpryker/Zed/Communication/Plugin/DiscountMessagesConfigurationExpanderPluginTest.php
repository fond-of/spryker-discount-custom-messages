<?php

namespace FondOfSpryker\Zed\DiscountCustomMessages\Communication\Plugin;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\DiscountCustomMessages\Business\DiscountCustomMessagesFacade;
use Generated\Shared\Transfer\DiscountConfiguratorTransfer;

class DiscountMessagesConfigurationExpanderPluginTest extends Unit
{
    /**
     * @return void
     */
    public function expandTest(): void
    {
        $plugin = new DiscountMessagesConfigurationExpanderPlugin();
        $facadeMock = $this->getMockBuilder(DiscountCustomMessagesFacade::class)->getMock();
        $discountConfiguratorTransferMock = $this->getMockBuilder(DiscountConfiguratorTransfer::class)->getMock();

        $plugin->setFacade($facadeMock);

        $facadeMock->expects($this->once())
            ->method('expandDiscountConfigurationWithCustomMessages')
            ->with($discountConfiguratorTransferMock);
    }
}
