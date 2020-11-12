<?php

namespace FondOfSpryker\Zed\DiscountCustomMessages\Communication\Plugin;

use FondOfSpryker\Zed\Discount\Dependency\Form\DefaultDiscountCreateConfiguratorExpanderPluginInterface;
use Generated\Shared\Transfer\DiscountConfiguratorTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfSpryker\Zed\DiscountCustomMessages\Business\DiscountCustomMessagesFacadeInterface getFacade()
 * @method \FondOfSpryker\Zed\DiscountCustomMessages\DiscountCustomMessagesConfig getConfig()
 * @method \FondOfSpryker\Zed\DiscountCustomMessages\Communication\DiscountCustomMessagesCommunicationFactory getFactory()
 */
class DefaultDiscountCustomMessagesCreateFormDataExpanderPlugin extends AbstractPlugin implements DefaultDiscountCreateConfiguratorExpanderPluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\DiscountConfiguratorTransfer $discountConfiguratorTransfer
     *
     * @return \Generated\Shared\Transfer\DiscountConfiguratorTransfer
     */
    public function expandDefaultDiscountConfigurator(DiscountConfiguratorTransfer $discountConfiguratorTransfer): DiscountConfiguratorTransfer
    {
        return $this->getFacade()->expandDefaultDiscountConfigurator($discountConfiguratorTransfer);
    }
}
