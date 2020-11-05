<?php

namespace FondOfSpryker\Zed\DiscountCustomMessages\Communication\Plugin;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\DiscountConfiguratorTransfer;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilder;

class DiscountCustomMessagesFormExpanderPluginTest extends Unit
{
    /**
     * @return void
     */
    public function expandFormTypeTest(): void
    {
        $plugin = new DiscountCustomMessagesFormExpanderPlugin();
        $formBuilderMock = $this->getMockBuilder(FormBuilder::class)->getMock();

        $formBuilderMock->expects($this->once())
            ->method('add')
            ->with(DiscountConfiguratorTransfer::DISCOUNT_CUSTOM_MESSAGES, CollectionType::class, []);

        $plugin->expandFormType($formBuilderMock, []);
    }
}
