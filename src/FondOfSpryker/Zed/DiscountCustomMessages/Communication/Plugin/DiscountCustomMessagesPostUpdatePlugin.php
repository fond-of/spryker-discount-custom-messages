<?php

namespace FondOfSpryker\Zed\DiscountCustomMessages\Communication\Plugin;

use Generated\Shared\Transfer\DiscountConfiguratorTransfer;
use Spryker\Zed\Discount\Dependency\Plugin\DiscountPostUpdatePluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfSpryker\Zed\DiscountCustomMessages\Business\DiscountCustomMessagesFacadeInterface getFacade()
 * @method \FondOfSpryker\Zed\DiscountCustomMessages\DiscountCustomMessagesConfig getConfig()
 * @method \FondOfSpryker\Zed\DiscountCustomMessages\Communication\DiscountCustomMessagesCommunicationFactory getFactory()
 */
class DiscountCustomMessagesPostUpdatePlugin extends AbstractPlugin implements DiscountPostUpdatePluginInterface
{
    /**
     * Specification:
     *
     * Plugin is triggered after discount is updated
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\DiscountConfiguratorTransfer $discountConfiguratorTransfer
     *
     * @return \Generated\Shared\Transfer\DiscountConfiguratorTransfer
     */
    public function postUpdate(DiscountConfiguratorTransfer $discountConfiguratorTransfer): DiscountConfiguratorTransfer
    {
        return $this->getFacade()->postUpdate($discountConfiguratorTransfer);
    }
}
