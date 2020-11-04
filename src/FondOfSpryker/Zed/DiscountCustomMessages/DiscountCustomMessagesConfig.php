<?php

namespace FondOfSpryker\Zed\DiscountCustomMessages;

use Spryker\Zed\Kernel\AbstractBundleConfig;

class DiscountCustomMessagesConfig extends AbstractBundleConfig
{
    public const DISCOUNT_CONFIG_DEFAULT_SUCCESS_MESSAGE = 'DISCOUNT_CONFIG_DEFAULT_SUCCESS_MESSAGE';
    public const DISCOUNT_CONFIG_DEFAULT_ERROR_MESSAGE = 'DISCOUNT_CONFIG_DEFAULT_ERROR_MESSAGE';

    /**
     * @return string
     */
    public function getDefaultSuccessMessage(): string
    {
        return $this->get(static::DISCOUNT_CONFIG_DEFAULT_SUCCESS_MESSAGE, 'discount.successfully.applied');
    }

    /**
     * @return string
     */
    public function getDefaultErrorMessage(): string
    {
        return $this->get(static::DISCOUNT_CONFIG_DEFAULT_ERROR_MESSAGE, 'cart.voucher.apply.failed');
    }
}
