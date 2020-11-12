<?php

namespace FondOfSpryker\Zed\DiscountCustomMessages\Persistence;

use Generated\Shared\Transfer\DiscountCustomMessageTransfer;

interface DiscountCustomMessagesEntityManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\DiscountCustomMessageTransfer $discountCustomMessageTransfer
     *
     * @return void
     */
    public function create(DiscountCustomMessageTransfer $discountCustomMessageTransfer): void;

    /**
     * @param \Generated\Shared\Transfer\DiscountCustomMessageTransfer $discountCustomMessageTransfer
     *
     * @return void
     */
    public function update(DiscountCustomMessageTransfer $discountCustomMessageTransfer): void;
}
