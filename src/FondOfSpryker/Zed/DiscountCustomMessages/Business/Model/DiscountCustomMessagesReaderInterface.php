<?php

namespace FondOfSpryker\Zed\DiscountCustomMessages\Business\Model;

use Generated\Shared\Transfer\DiscountConfiguratorTransfer;

interface DiscountCustomMessagesReaderInterface
{
    /**
     * @param \Generated\Shared\Transfer\DiscountConfiguratorTransfer $discountConfiguratorTransfer
     *
     * @return \Generated\Shared\Transfer\DiscountConfiguratorTransfer
     */
    public function expandDiscountCustomMessages(DiscountConfiguratorTransfer $discountConfiguratorTransfer);
}
