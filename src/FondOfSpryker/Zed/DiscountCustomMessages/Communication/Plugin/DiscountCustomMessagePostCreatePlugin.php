<?php

namespace FondOfSpryker\Zed\DiscountCustomMessages\Communication\Plugin;

use Generated\Shared\Transfer\DiscountConfiguratorTransfer;
use Orm\Zed\DiscountDiscountMessage\Persistence\FobDiscountCustomMessage;
use Spryker\Zed\Discount\Dependency\Plugin\DiscountPostCreatePluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfSpryker\Zed\DiscountCustomMessages\Communication\DiscountCustomMessagesCommunicationFactory getFactory()
 * @method \FondOfSpryker\Zed\DiscountCustomMessages\DiscountCustomMessagesConfig getConfig()
 * @method \FondOfSpryker\Zed\DiscountCustomMessages\Persistence\DiscountCustomMessagesQueryContainerInterface getQueryContainer()
 * @method \FondOfSpryker\Zed\DiscountCustomMessages\Business\DiscountCustomMessagesFacadeInterface getFacade()
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
        return $this->hydrateDiscountCustomMessageEntity($discountConfiguratorTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\DiscountConfiguratorTransfer $discountConfiguratorTransfer
     *
     * @return \Generated\Shared\Transfer\DiscountConfiguratorTransfer
     */
    protected function hydrateDiscountCustomMessageEntity(
        DiscountConfiguratorTransfer $discountConfiguratorTransfer
    ): DiscountConfiguratorTransfer {
        foreach ($discountConfiguratorTransfer->getDiscountCustomMessages() as $customMessageTransfer) {
            $locale = $this->getFactory()
                ->getLocaleQueryContainer()
                ->queryLocaleByName($customMessageTransfer->getLocale()->getLocaleName())->findOne();

            $discountCustomMessageEntity = $this->createDiscountCustomMessageEntity();
            $discountCustomMessageEntity->fromArray($customMessageTransfer->toArray());
            $discountCustomMessageEntity->setLocale($locale);
            $discountCustomMessageEntity->setFkDiscount($discountConfiguratorTransfer->getDiscountGeneral()->getIdDiscount());

            $discountCustomMessageEntity->save();
        }

        return $discountConfiguratorTransfer;
    }

    /**
     * @return \Orm\Zed\DiscountDiscountMessage\Persistence\FobDiscountCustomMessage
     */
    protected function createDiscountCustomMessageEntity(): FobDiscountCustomMessage
    {
        return new FobDiscountCustomMessage();
    }
}
