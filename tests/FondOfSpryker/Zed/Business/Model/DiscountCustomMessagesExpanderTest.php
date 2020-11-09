<?php

namespace FondOfSpryker\Zed\DiscountCustomMessages\Business\Model;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\DiscountCustomMessages\Dependency\Facade\DiscountCustomMessageToLocaleFacadeInterface;
use Generated\Shared\Transfer\DiscountConfiguratorTransfer;

class DiscountCustomMessagesExpanderTest extends Unit
{
    /**
     * @return void
     */
    public function testExpandDefaultDiscountConfigurator(): void
    {
        $localeCollection = include codecept_data_dir('LocaleCollection.php');
        $localeFacadeMock = $this->getMockBuilder(DiscountCustomMessageToLocaleFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $localeFacadeMock->expects($this->once())
            ->method('getLocaleCollection')
            ->willReturn($localeCollection);

        $discountConfiguratorTransferMock = $this->getMockBuilder(DiscountConfiguratorTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $discountConfiguratorTransferMock->expects($this->atLeastOnce())
            ->method('addDiscountCustomMessages');

        $discountCustomMessagesExpander = new DiscountCustomMessagesExpander($localeFacadeMock);
        $discountCustomMessagesExpander->expandDefaultDiscountConfigurator($discountConfiguratorTransferMock);
    }
}
