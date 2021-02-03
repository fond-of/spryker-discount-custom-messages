<?php

namespace FondOfSpryker\Zed\DiscountCustomMessages\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\DiscountCustomMessageTransfer;
use Generated\Shared\Transfer\LocaleTransfer;
use Orm\Zed\DiscountDiscountMessage\Persistence\FooDiscountCustomMessage;

class DiscountCustomMessageMapper implements DiscountCustomMessageMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\DiscountCustomMessageTransfer $discountCustomMessageTransfer
     * @param \Orm\Zed\DiscountDiscountMessage\Persistence\FooDiscountCustomMessage $discountCustomMessageEntity
     *
     * @return \Orm\Zed\DiscountDiscountMessage\Persistence\FooDiscountCustomMessage
     */
    public function mapTransferToEntity(
        DiscountCustomMessageTransfer $discountCustomMessageTransfer,
        FooDiscountCustomMessage $discountCustomMessageEntity
    ): FooDiscountCustomMessage {
        $discountCustomMessageEntity->fromArray(
            $discountCustomMessageTransfer->toArray(true)
        );

        $discountCustomMessageEntity
            ->setFkLocale($discountCustomMessageTransfer->getLocale()->getIdLocale())
            ->setFkDiscount($discountCustomMessageTransfer->getIdDiscount());

        return $discountCustomMessageEntity;
    }

    /**
     * @param \Orm\Zed\DiscountDiscountMessage\Persistence\FooDiscountCustomMessage $discountCustomMessageEntity
     * @param \Generated\Shared\Transfer\DiscountCustomMessageTransfer $discountCustomMessageTransfer
     *
     * @return \Generated\Shared\Transfer\DiscountCustomMessageTransfer
     */
    public function mapEntityToTransfer(
        FooDiscountCustomMessage $discountCustomMessageEntity,
        DiscountCustomMessageTransfer $discountCustomMessageTransfer
    ): DiscountCustomMessageTransfer {
        $discountCustomMessageTransfer->fromArray($discountCustomMessageEntity->toArray(), true);
        $localeTransfer = (new LocaleTransfer())->fromArray($discountCustomMessageEntity->getLocale()->toArray());

        $discountCustomMessageTransfer
            ->setIdDiscount($discountCustomMessageEntity->getFkDiscount())
            ->setLocale($localeTransfer)
            ->setIdLocale($localeTransfer->getIdLocale());

        return $discountCustomMessageTransfer;
    }
}
