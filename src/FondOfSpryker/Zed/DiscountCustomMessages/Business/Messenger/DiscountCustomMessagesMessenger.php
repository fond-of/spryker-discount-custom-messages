<?php

namespace FondOfSpryker\Zed\DiscountCustomMessages\Business\Messenger;

use FondOfSpryker\Zed\DiscountCustomMessages\Business\Model\DiscountCustomMessagesReaderInterface;
use FondOfSpryker\Zed\DiscountCustomMessages\Dependency\Facade\DiscountCustomMessageToMessengerFacadeInterface;
use FondOfSpryker\Zed\DiscountCustomMessages\DiscountCustomMessagesConfig;
use Generated\Shared\Transfer\DiscountTransfer;
use Generated\Shared\Transfer\MessageTransfer;

class DiscountCustomMessagesMessenger implements DiscountCustomMessagesMessengerInterface
{
    /**
     * @var \FondOfSpryker\Zed\DiscountCustomMessages\Dependency\Facade\DiscountCustomMessageToMessengerFacadeInterface
     */
    protected $messengerFacade;

    /**
     * @var \FondOfSpryker\Zed\DiscountCustomMessages\Business\Model\DiscountCustomMessagesReaderInterface
     */
    protected $customMessagesReader;

    /**
     * @var \FondOfSpryker\Zed\DiscountCustomMessages\DiscountCustomMessagesConfig
     */
    protected $customMessagesConfig;

    /**
     * @param \FondOfSpryker\Zed\DiscountCustomMessages\Business\Model\DiscountCustomMessagesReaderInterface $customMessagesReader
     * @param \FondOfSpryker\Zed\DiscountCustomMessages\Dependency\Facade\DiscountCustomMessageToMessengerFacadeInterface $messengerFacade
     * @param \FondOfSpryker\Zed\DiscountCustomMessages\DiscountCustomMessagesConfig $customMessagesConfig
     */
    public function __construct(
        DiscountCustomMessagesReaderInterface $customMessagesReader,
        DiscountCustomMessageToMessengerFacadeInterface $messengerFacade,
        DiscountCustomMessagesConfig $customMessagesConfig
    ) {
        $this->messengerFacade = $messengerFacade;
        $this->customMessagesReader = $customMessagesReader;
        $this->customMessagesConfig = $customMessagesConfig;
    }

    /**
     * @param \Generated\Shared\Transfer\DiscountTransfer $discountTransfer
     *
     * @return void
     */
    public function addSuccessMessage(DiscountTransfer $discountTransfer): void
    {
        $discountCustomMessageTransfer = $this->customMessagesReader->findCustomMessageByIdDiscountAndCurrentLocale(
            $discountTransfer
        );

        if ($discountCustomMessageTransfer === null) {
            return;
        }

        $value = $discountCustomMessageTransfer->getSuccessMessage()
            ?: $this->customMessagesConfig->getDefaultSuccessMessage();

        $messageTransfer = $this->createMessageTransfer($value, [
            'display_name' => $discountTransfer->getDisplayName(),
        ]);

        $this->messengerFacade->addSuccessMessage($messageTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\DiscountTransfer $discountTransfer
     *
     * @return void
     */
    public function addErrorMessage(DiscountTransfer $discountTransfer): void
    {
        $discountCustomMessageTransfer = $this->customMessagesReader->findCustomMessageByIdDiscountAndCurrentLocale(
            $discountTransfer
        );

        if ($discountCustomMessageTransfer === null) {
            return;
        }

        $value = $discountCustomMessageTransfer->getErrorMessage()
            ?: $this->customMessagesConfig->getDefaultErrorMessage();

        $messageTransfer = $this->createMessageTransfer($value, [
            'display_name' => $discountTransfer->getDisplayName(),
        ]);

        $this->messengerFacade->addErrorMessage($messageTransfer);
    }

    /**
     * @return void
     */
    protected function createMessageTransfer(string $value, array $params): MessageTransfer
    {
        $messageTransfer = new MessageTransfer();
        $messageTransfer->setValue($value);
        $messageTransfer->setParameters($params);

        return $messageTransfer;
    }
}
