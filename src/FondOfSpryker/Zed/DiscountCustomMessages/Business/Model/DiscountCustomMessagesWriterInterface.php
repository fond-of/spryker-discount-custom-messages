<?php

namespace FondOfSpryker\Zed\DiscountCustomMessages\Business\Model;

use Generated\Shared\Transfer\DiscountConfiguratorTransfer;
use Generated\Shared\Transfer\DiscountCustomMessageTransfer;

interface DiscountCustomMessagesWriterInterface
{
    /**
     * @param DiscountConfiguratorTransfer $discountConfiguratorTransfer
     *
     * @return DiscountConfiguratorTransfer
     */
    public function createByDiscountConfiguratorTransfer(DiscountConfiguratorTransfer $discountConfiguratorTransfer): DiscountConfiguratorTransfer;

    /**
     * @param \Generated\Shared\Transfer\DiscountConfiguratorTransfer $discountConfiguratorTransfer
     *
     * @return \Generated\Shared\Transfer\DiscountConfiguratorTransfer
     */
    public function update(DiscountConfiguratorTransfer $discountConfiguratorTransfer): DiscountConfiguratorTransfer;
}
