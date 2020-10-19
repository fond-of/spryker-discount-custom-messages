<?php

namespace FondOfSpryker\Zed\DiscountCustomMessages\Communication\Persistence;

use FondOfSpryker\Zed\Discount\Dependency\Persistence\DiscountEntityHydratorPluginInterface;
use Generated\Shared\Transfer\DiscountConfiguratorTransfer;
use Orm\Zed\Discount\Persistence\SpyDiscount;
use Orm\Zed\DiscountLocalizedMessages\Persistence\FobDiscountLocalizedMessages;
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
            $discountLocalizedMessagesEntity = $this->createDiscountLocalizedMessagesEntity();
            $discountLocalizedMessagesEntity->setLocale($this->createLocaleEntity()->fromArray($customMessageTransfer->getLocale()->toArray()));
            $discountLocalizedMessagesEntity->setSuccessMessage($customMessageTransfer->getSuccessMessage());
            $discountLocalizedMessagesEntity->setErrorMessage($customMessageTransfer->getErrorMessage());
            $discountLocalizedMessagesEntity->setFkLocale($customMessageTransfer->getLocale()->getIdLocale());

            $discountEntity->addFobDiscountLocalizedMessages($discountLocalizedMessagesEntity);
        }

        return $discountConfiguratorTransfer;
    }

    /**
     * @return \Orm\Zed\DiscountLocalizedMessages\Persistence\FobDiscountLocalizedMessages
     */
    protected function createDiscountLocalizedMessagesEntity(): FobDiscountLocalizedMessages
    {
        return new FobDiscountLocalizedMessages();
    }

    /**
     * @return \Orm\Zed\Locale\Persistence\SpyLocale
     */
    protected function createLocaleEntity()
    {
        return new SpyLocale();
    }
}
