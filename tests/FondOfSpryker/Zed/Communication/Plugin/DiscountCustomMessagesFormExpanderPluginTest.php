<?php

namespace FondOfSpryker\Zed\DiscountCustomMessages\Communication\Plugin;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\DiscountCustomMessages\Communication\Form\DiscountCustomMessageType;
use Generated\Shared\Transfer\DiscountConfiguratorTransfer;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilder;

class DiscountCustomMessagesFormExpanderPluginTest extends Unit
{
    /**
     * @return void
     */
    public function testExpandFormType(): void
    {
        $plugin = new DiscountCustomMessagesFormExpanderPlugin();

        $formBuilderMock = $this->getMockBuilder(FormBuilder::class)
            ->disableOriginalConstructor()
            ->getMock();

        $formBuilderMock->expects($this->once())
            ->method('add')
            ->with(DiscountConfiguratorTransfer::DISCOUNT_CUSTOM_MESSAGES, CollectionType::class, [
                'entry_type' => DiscountCustomMessageType::class,
            ]);

        $plugin->expandFormType($formBuilderMock, []);
    }
}
