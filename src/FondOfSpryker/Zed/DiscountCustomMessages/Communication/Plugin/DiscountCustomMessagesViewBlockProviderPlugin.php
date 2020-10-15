<?php

namespace FondOfSpryker\Zed\DiscountCustomMessages\Communication\Plugin;

use Spryker\Zed\Discount\Dependency\Plugin\DiscountViewBlockProviderPluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfSpryker\Zed\DiscountCustomMessages\Business\DiscountCustomMessagesFacadeInterface getFacade()
 * @method \FondOfSpryker\Zed\DiscountCustomMessages\Communication\DiscountCustomMessagesCommunicationFactory getFactory()
 */
class DiscountCustomMessagesViewBlockProviderPlugin extends AbstractPlugin implements DiscountViewBlockProviderPluginInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @return string
     */
    public function getUrl()
    {
        return '/discount-custom-messages/discount-view-block/index';
    }
}
