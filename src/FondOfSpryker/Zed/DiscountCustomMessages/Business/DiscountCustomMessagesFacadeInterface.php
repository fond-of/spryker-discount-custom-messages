<?php

namespace FondOfSpryker\Zed\DiscountCustomMessages\Business;

use Generated\Shared\Transfer\DiscountConfiguratorTransfer;

interface DiscountCustomMessagesFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\DiscountConfiguratorTransfer $discountConfiguratorTransfer
     *
     * @return \Generated\Shared\Transfer\DiscountConfiguratorTransfer
     */
    public function expandDiscountConfigurationWithCustomMessages(
        DiscountConfiguratorTransfer $discountConfiguratorTransfer
    ): DiscountConfiguratorTransfer;
}
