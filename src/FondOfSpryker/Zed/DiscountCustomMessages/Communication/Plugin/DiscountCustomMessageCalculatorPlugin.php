<?php

namespace FondOfSpryker\Zed\DiscountCustomMessages\Communication\Plugin;

use FondOfSpryker\Zed\Discount\Dependency\Calculator\CustomMessageConnectorPluginInterface;
use Generated\Shared\Transfer\DiscountTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfSpryker\Zed\DiscountCustomMessages\Business\DiscountCustomMessagesFacadeInterface getFacade()
 * @method \FondOfSpryker\Zed\DiscountCustomMessages\DiscountCustomMessagesConfig getConfig()
 * @method \FondOfSpryker\Zed\DiscountCustomMessages\Communication\DiscountCustomMessagesCommunicationFactory getFactory()
 */
class DiscountCustomMessageCalculatorPlugin extends AbstractPlugin implements CustomMessageConnectorPluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\DiscountTransfer $discountTransfer
     *
     * @return void
     */
    public function addSuccessMessageFromDiscountTransfer(DiscountTransfer $discountTransfer): void
    {
        $this->getFactory()
            ->createDiscountCustomMessagesMessenger()
            ->addSuccessMessageFromDiscountTransfer($discountTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\DiscountTransfer $discountTransfer
     *
     * @return void
     */
    public function addErrorMessageFromDiscountTransfer(DiscountTransfer $discountTransfer): void
    {
        $this->getFactory()
            ->createDiscountCustomMessagesMessenger()
            ->addErrorMessageFromDiscountTransfer($discountTransfer);
    }

    /**
     * @param string $successMessage
     *
     * @return void
     */
    public function addSuccessMessageFromString(string $successMessage): void
    {
        $this->getFactory()
            ->createDiscountCustomMessagesMessenger()
            ->addSuccessMessageFromString($successMessage);
    }

    /**
     * @param string $errorMessage
     *
     * @return void
     */
    public function addVoucherNotFoundErrorMessage(): void
    {
        $this->getFactory()
            ->createDiscountCustomMessagesMessenger()
            ->addVoucherNotFoundErrorMessage();
    }
}
