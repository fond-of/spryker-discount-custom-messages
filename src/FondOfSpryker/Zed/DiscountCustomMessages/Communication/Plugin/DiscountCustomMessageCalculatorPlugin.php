<?php

namespace FondOfSpryker\Zed\DiscountCustomMessages\Communication\Plugin;

use FondOfSpryker\Zed\Discount\Dependency\Calculator\CustomMessageConnectorPluginInterface;
use Generated\Shared\Transfer\DiscountTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfSpryker\Zed\DiscountCustomMessages\Business\DiscountCustomMessagesFacadeInterface getFacade()
 * @method \FondOfSpryker\Zed\DiscountCustomMessages\Communication\DiscountCustomMessagesCommunicationFactory getFactory()
 * @method \FondOfSpryker\Zed\DiscountCustomMessages\Persistence\DiscountCustomMessagesQueryContainerInterface getQueryContainer()
 * @method \FondOfSpryker\Zed\DiscountCustomMessages\DiscountCustomMessagesConfig getConfig()
 */
class DiscountCustomMessageCalculatorPlugin extends AbstractPlugin implements CustomMessageConnectorPluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\DiscountTransfer $discountTransfer
     *
     * @return void
     */
    public function addSuccessMessage(DiscountTransfer $discountTransfer): void
    {
        $this->getFactory()
            ->createDiscountCustomMessagesMessenger()
            ->addSuccessMessage($discountTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\DiscountTransfer $discountTransfer
     *
     * @return void
     */
    public function addErrorMessage(DiscountTransfer $discountTransfer): void
    {
        $this->getFactory()
            ->createDiscountCustomMessagesMessenger()
            ->addErrorMessage($discountTransfer);
    }
}
