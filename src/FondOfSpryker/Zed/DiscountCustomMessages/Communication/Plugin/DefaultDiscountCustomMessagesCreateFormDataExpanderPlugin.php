<?php

namespace FondOfSpryker\Zed\DiscountCustomMessages\Communication\Plugin;

use FondOfSpryker\Zed\Discount\Dependency\Form\DefaultDiscountCreateConfiguratorExpanderPluginInterface;
use Generated\Shared\Transfer\DiscountConfiguratorTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfSpryker\Zed\DiscountCustomMessages\Business\DiscountCustomMessagesFacadeInterface getFacade()
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
