<?php

namespace FondOfSpryker\Zed\DiscountCustomMessages\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\DiscountCustomMessageTransfer;
use Orm\Zed\DiscountDiscountMessage\Persistence\FobDiscountCustomMessage;

interface DiscountCustomMessageMapperInterface
{
    public function mapTransferToEntity(
        DiscountCustomMessageTransfer $discountCustomMessageTransfer,
        FobDiscountCustomMessage $discountCustomMessageEntity
    ): FobDiscountCustomMessage;

    /**
     * @param FobDiscountCustomMessage $discountCustomMessageEntity
     * @param DiscountCustomMessageTransfer $discountCustomMessageTransfer
     *
     * @return DiscountCustomMessageTransfer
     */
    public function mapEntityToTransfer(
        FobDiscountCustomMessage $discountCustomMessageEntity,
        DiscountCustomMessageTransfer $discountCustomMessageTransfer
    ): DiscountCustomMessageTransfer;
}
