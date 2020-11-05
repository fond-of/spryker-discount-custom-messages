<?php

namespace FondOfSpryker\Zed\DiscountCustomMessages\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\DiscountCustomMessageTransfer;
use Generated\Shared\Transfer\LocaleTransfer;
use Orm\Zed\DiscountDiscountMessage\Persistence\FobDiscountCustomMessage;

class DiscountCustomMessageMapper implements DiscountCustomMessageMapperInterface
{
    public function mapTransferToEntity(
        DiscountCustomMessageTransfer $discountCustomMessageTransfer,
        FobDiscountCustomMessage $discountCustomMessageEntity
    ): FobDiscountCustomMessage {
        $discountCustomMessageEntity->fromArray(
            $discountCustomMessageTransfer->toArray(true)
        );

        $discountCustomMessageEntity
            ->setFkLocale($discountCustomMessageTransfer->getLocale()->getIdLocale())
            ->setFkDiscount($discountCustomMessageTransfer->getIdDiscount());

        return $discountCustomMessageEntity;
    }

    /**
     * @param \Orm\Zed\DiscountDiscountMessage\Persistence\FobDiscountCustomMessage $discountCustomMessageEntity
     * @param \Generated\Shared\Transfer\DiscountCustomMessageTransfer $discountCustomMessageTransfer
     *
     * @return \Generated\Shared\Transfer\DiscountCustomMessageTransfer
     */
    public function mapEntityToTransfer(
        FobDiscountCustomMessage $discountCustomMessageEntity,
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
