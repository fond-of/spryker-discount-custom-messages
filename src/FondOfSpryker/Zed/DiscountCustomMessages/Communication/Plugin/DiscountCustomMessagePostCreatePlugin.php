<?php

namespace FondOfSpryker\Zed\DiscountCustomMessages\Communication\Plugin;

use Generated\Shared\Transfer\DiscountConfiguratorTransfer;
use Spryker\Zed\Discount\Dependency\Plugin\DiscountPostCreatePluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfSpryker\Zed\DiscountCustomMessages\Business\DiscountCustomMessagesFacadeInterface getFacade()
 * @method \FondOfSpryker\Zed\DiscountCustomMessages\DiscountCustomMessagesConfig getConfig()
 * @method \FondOfSpryker\Zed\DiscountCustomMessages\Communication\DiscountCustomMessagesCommunicationFactory getFactory()
 */
class DiscountCustomMessagePostCreatePlugin extends AbstractPlugin implements DiscountPostCreatePluginInterface
{
    /**
     * Specification:
     *
     * Plugin is triggered after discount is created
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\DiscountConfiguratorTransfer $discountConfiguratorTransfer
     *
     * @return \Generated\Shared\Transfer\DiscountConfiguratorTransfer
     */
    public function postCreate(DiscountConfiguratorTransfer $discountConfiguratorTransfer): DiscountConfiguratorTransfer
    {
        return $this->getFacade()->createDiscountCustomMessages($discountConfiguratorTransfer);
    }
}
