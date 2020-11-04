<?php

namespace FondOfSpryker\Zed\DiscountCustomMessages\Business\Model\Mapper;

use Generated\Shared\Transfer\DiscountCustomMessageTransfer;
use Orm\Zed\DiscountDiscountMessage\Persistence\FobDiscountCustomMessage;

interface DiscountCustomMessagesMapperInterface
{
    /**
     * @param \Orm\Zed\DiscountDiscountMessage\Persistence\FobDiscountCustomMessage $discountCustomMessagesEntity
     *
     * @return \Generated\Shared\Transfer\DiscountCustomMessageTransfer
     */
    public function mapTransfer(FobDiscountCustomMessage $discountCustomMessagesEntity): DiscountCustomMessageTransfer;

    /**
     * @param \Orm\Zed\DiscountDiscountMessage\Persistence\FobDiscountCustomMessage[]
     *
     * @return \Generated\Shared\Transfer\DiscountCustomMessageTransfer[]
     */
    public function mapTransferCollection(array $discountCustomMessageEntities): array;
}
