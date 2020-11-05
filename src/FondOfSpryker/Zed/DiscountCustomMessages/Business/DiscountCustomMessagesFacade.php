<?php

namespace FondOfSpryker\Zed\DiscountCustomMessages\Business;

use Generated\Shared\Transfer\DiscountConfiguratorTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfSpryker\Zed\DiscountCustomMessages\Business\DiscountCustomMessagesBusinessFactory getFactory()
 * @method \FondOfSpryker\Zed\DiscountCustomMessages\Persistence\DiscountCustomMessagesRepositoryInterface getRepository()
 */
class DiscountCustomMessagesFacade extends AbstractFacade implements DiscountCustomMessagesFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\DiscountConfiguratorTransfer $discountConfiguratorTransfer
     *
     * @return \Generated\Shared\Transfer\DiscountConfiguratorTransfer
     */
    public function expandDefaultDiscountConfigurator(DiscountConfiguratorTransfer $discountConfiguratorTransfer): DiscountConfiguratorTransfer
    {
        return $this->getFactory()
            ->createDiscountCustomMessagesExpander()
            ->expandDefaultDiscountConfigurator($discountConfiguratorTransfer);
    }

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
            ->update($discountConfiguratorTransfer);
    }

    /**
     * @param DiscountConfiguratorTransfer $discountConfiguratorTransfer
     *
     * @return DiscountConfiguratorTransfer
     */
    public function createDiscountCustomMessages(
        DiscountConfiguratorTransfer $discountConfiguratorTransfer)
    : DiscountConfiguratorTransfer
    {
        return $this->getFactory()
            ->createDiscountCustomMessagesWriter()
            ->createByDiscountConfiguratorTransfer($discountConfiguratorTransfer);
    }
}
