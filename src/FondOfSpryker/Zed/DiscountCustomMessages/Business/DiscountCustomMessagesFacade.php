<?php

namespace FondOfSpryker\Zed\DiscountCustomMessages\Business;

use Generated\Shared\Transfer\DiscountConfiguratorTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfSpryker\Zed\DiscountCustomMessages\Business\DiscountCustomMessagesBusinessFactory getFactory()
 */
class DiscountCustomMessagesFacade extends AbstractFacade implements DiscountCustomMessagesFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\DiscountConfiguratorTransfer $discountConfiguratorTransfer
     *
     * @return \Generated\Shared\Transfer\DiscountConfiguratorTransfer
     */
    public function expandDiscountConfigurationWithCustomMessages(DiscountConfiguratorTransfer $discountConfiguratorTransfer): DiscountConfiguratorTransfer
    {
        return $this->getFactory()
            ->createDiscountCustomMessagesReader()
            ->expandDiscountCustomMessages($discountConfiguratorTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\DiscountConfiguratorTransfer $discountConfiguratorTransfer
     *
     * @return \Generated\Shared\Transfer\DiscountConfiguratorTransfer
     */
    public function postUpdate(DiscountConfiguratorTransfer $discountConfiguratorTransfer): DiscountConfiguratorTransfer
    {
        return $this->getFactory()
            ->createDiscountCustomMessagesWriter()
            ->updateDiscountCustomMessages($discountConfiguratorTransfer);
    }
}
