<?php

namespace FondOfSpryker\Zed\DiscountCustomMessages\Communication\Plugin;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\DiscountCustomMessages\Business\DiscountCustomMessagesFacade;
use Generated\Shared\Transfer\DiscountConfiguratorTransfer;

class DiscountCustomMessagePostCreatePluginTest extends Unit
{
    /**
     * @return void
     */
    public function postCreateTest(): void
    {
        $plugin = new DiscountCustomMessagePostCreatePlugin();
        $facadeMock = $this->getMockBuilder(DiscountCustomMessagesFacade::class)->getMock();
        $discountConfiguratorTransferMock = $this->getMockBuilder(DiscountConfiguratorTransfer::class)->getMock();

        $plugin->setFacade($facadeMock);

        $facadeMock->expects($this->once())
            ->method('createDiscountCustomMessages')
            ->with($discountConfiguratorTransferMock);

        $plugin->postCreate($discountConfiguratorTransferMock);
    }
}
