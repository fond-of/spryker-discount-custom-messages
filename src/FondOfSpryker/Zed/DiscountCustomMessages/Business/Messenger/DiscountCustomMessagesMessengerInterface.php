<?php

namespace FondOfSpryker\Zed\DiscountCustomMessages\Business\Messenger;

use Generated\Shared\Transfer\DiscountTransfer;

interface DiscountCustomMessagesMessengerInterface
{
    /**
     * @param \Generated\Shared\Transfer\DiscountTransfer $discountTransfer
     *
     * @return void
     */
    public function addSuccessMessageFromDiscountTransfer(DiscountTransfer $discountTransfer): void;

    /**
     * @param string $successMessage
     *
     * @return void
     */
    public function addSuccessMessageFromString(string $successMessage): void;

    /**
     * @param \Generated\Shared\Transfer\DiscountTransfer $discountTransfer
     *
     * @return void
     */
    public function addErrorMessageFromDiscountTransfer(DiscountTransfer $discountTransfer): void;

    /**
     * @return void
     */
    public function addVoucherNotFoundErrorMessage(): void;
}
