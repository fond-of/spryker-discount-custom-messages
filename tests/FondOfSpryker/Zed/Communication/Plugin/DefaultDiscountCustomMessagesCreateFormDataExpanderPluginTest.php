<?php

namespace FondOfSpryker\Zed\DiscountCustomMessages\Communication\Plugin;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\DiscountCustomMessages\Business\DiscountCustomMessagesFacade;
use Generated\Shared\Transfer\DiscountConfiguratorTransfer;

class DefaultDiscountCustomMessagesCreateFormDataExpanderPluginTest extends Unit
{
    /**
     * @return void
     */
    public function testExpandDefaultDiscountConfigurator(): void
    {
        $plugin = new DefaultDiscountCustomMessagesCreateFormDataExpanderPlugin();
        $discountConfiguratorTransferMock = $this->getMockBuilder(DiscountConfiguratorTransfer::class)->getMock();

        $facadeMock = $this->getMockBuilder(DiscountCustomMessagesFacade::class)->getMock();

        $plugin->setFacade($facadeMock);

        $facadeMock->expects($this->once())
            ->method('expandDefaultDiscountConfigurator')
            ->with($discountConfiguratorTransferMock);

        $plugin->expandDefaultDiscountConfigurator($discountConfiguratorTransferMock);
    }
}
