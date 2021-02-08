<?php

namespace FondOfSpryker\Zed\DiscountCustomMessages\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\DiscountCustomMessageTransfer;
use Orm\Zed\DiscountDiscountMessage\Persistence\FooDiscountCustomMessage;

interface DiscountCustomMessageMapperInterface
{
    public function mapTransferToEntity(
        DiscountCustomMessageTransfer $discountCustomMessageTransfer,
        FooDiscountCustomMessage $discountCustomMessageEntity
    ): FooDiscountCustomMessage;

    /**
     * @param \Orm\Zed\DiscountDiscountMessage\Persistence\FooDiscountCustomMessage $discountCustomMessageEntity
     * @param \Generated\Shared\Transfer\DiscountCustomMessageTransfer $discountCustomMessageTransfer
     *
     * @return \Generated\Shared\Transfer\DiscountCustomMessageTransfer
     */
    public function mapEntityToTransfer(
        FooDiscountCustomMessage $discountCustomMessageEntity,
        DiscountCustomMessageTransfer $discountCustomMessageTransfer
    ): DiscountCustomMessageTransfer;
}
