<?php

namespace FondOfSpryker\Zed\DiscountCustomMessages\Communication\Plugin;

use Generated\Shared\Transfer\DiscountConfiguratorTransfer;
use Generated\Shared\Transfer\DiscountCustomMessageTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use FondOfSpryker\Zed\Discount\Dependency\Form\DefaultDiscountCreateConfiguratorExpanderPluginInterface;

/**
 * @method \FondOfSpryker\Zed\DiscountCustomMessages\Business\DiscountCustomMessagesFacadeInterface getFacade()
 * @method \FondOfSpryker\Zed\DiscountCustomMessages\Communication\DiscountCustomMessagesCommunicationFactory getFactory()
 */
class DefaultDiscountCustomMessagesFormDataExpanderPlugin extends AbstractPlugin implements DefaultDiscountCreateConfiguratorExpanderPluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\DiscountConfiguratorTransfer $discountConfiguratorTransfer
     *
     * @return \Generated\Shared\Transfer\DiscountConfiguratorTransfer
     */
    public function expandDefaultDiscountConfigurator(DiscountConfiguratorTransfer $discountConfiguratorTransfer): DiscountConfiguratorTransfer
    {
        $locales = $this->getFactory()
            ->getLocaleFacade()
            ->getLocaleCollection();

        foreach ($locales as $localeTransfer) {
            $discountCustomMessageTransfer = new DiscountCustomMessageTransfer();
            $discountCustomMessageTransfer->setLocale($localeTransfer);

            $discountConfiguratorTransfer->addDiscountCustomMessages($discountCustomMessageTransfer);
        }

        return $discountConfiguratorTransfer;
    }
}