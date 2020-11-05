<?php

namespace FondOfSpryker\Zed\DiscountCustomMessages\Dependency\Facade;

use Generated\Shared\Transfer\FlashMessagesTransfer;
use Generated\Shared\Transfer\MessageTransfer;

interface DiscountCustomMessageToMessengerFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\MessageTransfer $messageTransfer
     */
    public function addErrorMessage(MessageTransfer $messageTransfer): void;

    /**
     * @param \Generated\Shared\Transfer\MessageTransfer $messageTransfer
     */
    public function addSuccessMessage(MessageTransfer $messageTransfer): void;

    /**
     * @return \Generated\Shared\Transfer\FlashMessagesTransfer
     */
    public function getStoredMessages(): FlashMessagesTransfer;
}
