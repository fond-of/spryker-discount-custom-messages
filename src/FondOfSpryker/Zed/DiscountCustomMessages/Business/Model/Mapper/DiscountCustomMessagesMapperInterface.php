<?php

namespace FondOfSpryker\Zed\DiscountCustomMessages\Business\Model\Mapper;

interface DiscountCustomMessagesMapperInterface
{
    /**
     * @param \Orm\Zed\DiscountDiscountMessage\Persistence\FobDiscountCustomMessage[]
     *
     * @return \Generated\Shared\Transfer\DiscountCustomMessageTransfer[]
     */
    public function mapTransfer(array $discountCustomMessageEntities): array;
}
