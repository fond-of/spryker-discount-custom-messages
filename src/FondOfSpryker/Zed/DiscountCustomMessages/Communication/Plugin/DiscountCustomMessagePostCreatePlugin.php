<?php

namespace FondOfSpryker\Zed\DiscountCustomMessages\Communication\Plugin;

use Generated\Shared\Transfer\DiscountConfiguratorTransfer;
use Generated\Shared\Transfer\LocaleTransfer;
use Orm\Zed\DiscountDiscountMessage\Persistence\FobDiscountCustomMessage;
use Orm\Zed\Locale\Persistence\SpyLocale;
use Spryker\Zed\Discount\Dependency\Plugin\DiscountPostCreatePluginInterface;

class DiscountCustomMessagePostCreatePlugin implements DiscountPostCreatePluginInterface
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
        return $this->hydrateDiscountCustomMessageEntity(
            $discountConfiguratorTransfer,
            $this->createDiscountCustomMessageEntity()
        );
    }

    /**
     * @param \Generated\Shared\Transfer\DiscountConfiguratorTransfer $discountConfiguratorTransfer
     * @param \Orm\Zed\DiscountDiscountMessage\Persistence\FobDiscountCustomMessage $discountCustomMessageEntity
     *
     * @return \Generated\Shared\Transfer\DiscountConfiguratorTransfer
     */
    protected function hydrateDiscountCustomMessageEntity(
        DiscountConfiguratorTransfer $discountConfiguratorTransfer,
        FobDiscountCustomMessage $discountCustomMessageEntity
    ): DiscountConfiguratorTransfer {
        foreach ($discountConfiguratorTransfer->getDiscountCustomMessages() as $customMessageTransfer) {
            $discountCustomMessageEntity->fromArray($customMessageTransfer->toArray());
            $discountCustomMessageEntity->setLocale($this->hydrateLocaleEntity($customMessageTransfer->getLocale()));
        }

        return $discountConfiguratorTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\LocaleTransfer $localeTransfer
     *
     * @return \Orm\Zed\Locale\Persistence\SpyLocale
     */
    protected function hydrateLocaleEntity(LocaleTransfer $localeTransfer): SpyLocale
    {
        $localeEntity = $this->createLocaleEntity();
        $localeEntity->fromArray($localeTransfer->toArray());

        return $localeEntity;
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
    protected function createLocaleEntity(): SpyLocale
    {
        return new SpyLocale();
    }
}
