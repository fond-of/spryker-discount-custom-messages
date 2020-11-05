<?php

namespace FondOfSpryker\Zed\DiscountCustomMessages\Communication\Plugin;

use Generated\Shared\Transfer\DiscountConfiguratorTransfer;
use Spryker\Zed\Discount\Dependency\Plugin\DiscountConfigurationExpanderPluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfSpryker\Zed\DiscountCustomMessages\Business\DiscountCustomMessagesFacadeInterface getFacade()
 */
class DiscountMessagesConfigurationExpanderPlugin extends AbstractPlugin implements DiscountConfigurationExpanderPluginInterface
{
    /**
     *  Specification:
     *   - This plugin is used to add additional data to DiscountConfigurationTransfer, which is then mapped to Zed discount form.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\DiscountConfiguratorTransfer $discountConfiguratorTransfer
     *
     * @return \Generated\Shared\Transfer\DiscountConfiguratorTransfer
     */
    public function expand(DiscountConfiguratorTransfer $discountConfiguratorTransfer)
    {
        return $this->getFacade()->expandDiscountConfigurationWithCustomMessages($discountConfiguratorTransfer);
    }
}
