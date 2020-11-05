<?php

namespace FondOfSpryker\Zed\DiscountCustomMessages\Dependency\Facade;

use Generated\Shared\Transfer\FlashMessagesTransfer;
use Generated\Shared\Transfer\MessageTransfer;
use Spryker\Zed\Messenger\Business\MessengerFacadeInterface;

class DiscountCustomMessageToMessengerFacadeBridge implements DiscountCustomMessageToMessengerFacadeInterface
{
    /**
     * @var \Spryker\Zed\Messenger\Business\MessengerFacadeInterface
     */
    private $messengerFacade;

    public function __construct(MessengerFacadeInterface $messengerFacade)
    {
        $this->messengerFacade = $messengerFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\MessageTransfer $messageTransfer
     *
     * @return void
     */
    public function addErrorMessage(MessageTransfer $messageTransfer): void
    {
        $this->messengerFacade->addErrorMessage($messageTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\MessageTransfer $messageTransfer
     *
     * @return void
     */
    public function addSuccessMessage(MessageTransfer $messageTransfer): void
    {
        $this->messengerFacade->addSuccessMessage($messageTransfer);
    }

    /**
     * @return \Generated\Shared\Transfer\FlashMessagesTransfer
     */
    public function getStoredMessages(): FlashMessagesTransfer
    {
        return $this->messengerFacade->getStoredMessages();
    }
}