<?php

namespace FondOfSpryker\Zed\DiscountCustomMessages\Business\Messenger;

use Generated\Shared\Transfer\DiscountTransfer;

interface DiscountCustomMessagesMessengerInterface
{
    /**
     * @param \Generated\Shared\Transfer\DiscountTransfer $discountTransfer
     */
    public function addSuccessMessage(DiscountTransfer $discountTransfer): void;

    /**
     * @param \Generated\Shared\Transfer\DiscountTransfer $discountTransfer
     */
    public function addErrorMessage(DiscountTransfer $discountTransfer): void;
}
