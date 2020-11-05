<?php

namespace FondOfSpryker\Zed\DiscountCustomMessages\Communication\Plugin;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\DiscountCustomMessages\Business\DiscountCustomMessagesFacade;
use Generated\Shared\Transfer\DiscountConfiguratorTransfer;

class DiscountCustomMessagesPostUpdatePluginTest extends Unit
{
    /**
     * @return void
     */
    public function postUpdateTest(): void
    {
        $plugin = new DiscountCustomMessagesPostUpdatePlugin();
        $facadeMock = $this->getMockBuilder(DiscountCustomMessagesFacade::class)->getMock();
        $discountConfiguratorTransferMock = $this->getMockBuilder(DiscountConfiguratorTransfer::class)->getMock();

        $plugin->setFacade($facadeMock);

        $facadeMock->expects($this->once())
            ->method('postUpdate')
            ->with($discountConfiguratorTransferMock);

        $plugin->postUpdate($discountConfiguratorTransferMock);
    }
}
