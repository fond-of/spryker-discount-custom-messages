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
    public function addSuccessMessageFromDiscountTransfer(DiscountTransfer $discountTransfer): void
    {
        $discountCustomMessageTransfer = $this->customMessagesReader->findCustomMessageByIdDiscountAndCurrentLocale(
            $discountTransfer
        );

        if ($discountCustomMessageTransfer === null || !$discountCustomMessageTransfer->getSuccessMessage()) {
            $messageTransfer = $this->createMessageTransfer(
                $this->customMessagesConfig->getDefaultSuccessMessage(),
                ['display_name' => $discountTransfer->getDisplayName()]
            );

            $this->messengerFacade->addSuccessMessage($messageTransfer);

            return;
        }

        $messageTransfer = $this->createMessageTransfer(
            $discountCustomMessageTransfer->getSuccessMessage(),
            ['display_name' => $discountTransfer->getDisplayName()]
        );

        $this->messengerFacade->addSuccessMessage($messageTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\DiscountTransfer $discountTransfer
     *
     * @return void
     */
    public function addErrorMessageFromDiscountTransfer(DiscountTransfer $discountTransfer): void
    {
        $discountCustomMessageTransfer = $this->customMessagesReader->findCustomMessageByIdDiscountAndCurrentLocale(
            $discountTransfer
        );

        if ($discountCustomMessageTransfer === null || !$discountCustomMessageTransfer->getErrorMessage()) {
            $this->addVoucherNotFoundErrorMessage();

            return;
        }

        $messageTransfer = $this->createMessageTransfer(
            $discountCustomMessageTransfer->getErrorMessage(),
            ['display_name' => $discountTransfer->getDisplayName()]
        );

        $this->messengerFacade->addErrorMessage($messageTransfer);
    }

    /**
     * @return void
     */
    protected function createMessageTransfer(string $value, array $params): MessageTransfer
    {
        $messageTransfer = (new MessageTransfer())
            ->setValue($value)
            ->setParameters($params);

        return $messageTransfer;
    }

    /**
     * @param string $successMessage
     *
     * @return void
     */
    public function addSuccessMessageFromString(string $successMessage): void
    {
        $messageTransfer = $this->createMessageTransfer(
            $successMessage,
            []
        );

        $this->messengerFacade->addSuccessMessage($messageTransfer);
    }

    /**
     * @return void
     */
    public function addVoucherNotFoundErrorMessage(): void
    {
        $messageTransfer = $this->createMessageTransfer(
            $this->customMessagesConfig->getDefaultErrorMessage(),
            []
        );

        $this->messengerFacade->addErrorMessage($messageTransfer);
    }
}
