<?php

namespace FondOfSpryker\Zed\DiscountCustomMessages\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\DiscountCustomMessageTransfer;
use Orm\Zed\DiscountDiscountMessage\Persistence\FobDiscountCustomMessage;

class DiscountCustomMessageMapper implements DiscountCustomMessageMapperInterface
{
    public function mapTransferToEntity(DiscountCustomMessageTransfer $discountCustomMessageTransfer, FobDiscountCustomMessage $discountCustomMessageEntity): FobDiscountCustomMessage
    {
        $discountCustomMessageEntity->fromArray(
            $discountCustomMessageTransfer->toArray(true)
        );

        $discountCustomMessageEntity
            ->setFkLocale($discountCustomMessageTransfer->getLocale()->getIdLocale())
            ->setFkDiscount($discountCustomMessageTransfer->getIdDiscount());

        return $discountCustomMessageEntity;
    }

    /**
     * @param FobDiscountCustomMessage $discountCustomMessageEntity
     * @param DiscountCustomMessageTransfer $discountCustomMessageTransfer
     *
     * @return DiscountCustomMessageTransfer
     */
    public function mapEntityToTransfer(FobDiscountCustomMessage $discountCustomMessageEntity, DiscountCustomMessageTransfer $discountCustomMessageTransfer): DiscountCustomMessageTransfer
    {
        $discountCustomMessageTransfer->fromArray($discountCustomMessageEntity->toArray(), true);

        return $discountCustomMessageTransfer;
    }
}
