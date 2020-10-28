<?php

namespace FondOfSpryker\Zed\DiscountCustomMessages\Business\Model\Mapper;

interface DiscountCustomMessagesMapperInterface
{
    /**
     * @param array $discountCustomMessagesEntities
     *
     * @return \Generated\Shared\Transfer\DiscountCustomMessageTransfer[]
     */
    public function mapTransfer(array $discountCustomMessagesEntities): array;
}
