<?php

namespace FondOfSpryker\Zed\DiscountCustomMessages\Communication\Persistence;

use FondOfSpryker\Zed\Discount\Dependency\Persistence\DiscountEntityHydratorPluginInterface;
use Generated\Shared\Transfer\DiscountConfiguratorTransfer;
use Orm\Zed\Discount\Persistence\SpyDiscount;
use Orm\Zed\DiscountDiscountMessage\Persistence\FobDiscountCustomMessage;
use Orm\Zed\Locale\Persistence\SpyLocale;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

class DiscountCustomMessageEntityHydratorPlugin extends AbstractPlugin implements DiscountEntityHydratorPluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\DiscountConfiguratorTransfer $discountConfiguratorTransfer
     * @param \Orm\Zed\Discount\Persistence\SpyDiscount $discountEntity
     *
     * @return \Generated\Shared\Transfer\DiscountConfiguratorTransfer
     */
    public function hydrateDiscountEntity(DiscountConfiguratorTransfer $discountConfiguratorTransfer, SpyDiscount $discountEntity): DiscountConfiguratorTransfer
    {
        foreach ($discountConfiguratorTransfer->getDiscountCustomMessages() as $customMessageTransfer) {
            $discountCustomMessageEntity = $this->createDiscountCustomMessageEntity();
            $discountCustomMessageEntity->setLocale($this->createLocaleEntity()->fromArray($customMessageTransfer->getLocale()->toArray()));
            $discountCustomMessageEntity->setSuccessMessage($customMessageTransfer->getSuccessMessage());
            $discountCustomMessageEntity->setErrorMessage($customMessageTransfer->getErrorMessage());
            $discountCustomMessageEntity->setFkLocale($customMessageTransfer->getLocale()->getIdLocale());

            $discountEntity->addFobDiscountCustomMessage($discountCustomMessageEntity);
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

    /**
     * @return \Orm\Zed\Locale\Persistence\SpyLocale
     */
    protected function createLocaleEntity()
    {
        return new SpyLocale();
    }
}
