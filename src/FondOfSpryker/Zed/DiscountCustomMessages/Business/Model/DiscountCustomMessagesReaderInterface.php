<?php

namespace FondOfSpryker\Zed\DiscountCustomMessages\Business\Model;

use Generated\Shared\Transfer\DiscountConfiguratorTransfer;
use Generated\Shared\Transfer\DiscountCustomMessageTransfer;
use Generated\Shared\Transfer\DiscountTransfer;

interface DiscountCustomMessagesReaderInterface
{
    /**
     * @param \Generated\Shared\Transfer\DiscountConfiguratorTransfer $discountConfiguratorTransfer
     *
     * @return \Generated\Shared\Transfer\DiscountConfiguratorTransfer
     */
    public function expandDiscountCustomMessages(DiscountConfiguratorTransfer $discountConfiguratorTransfer);

    /**
     * @param int $idDiscount
     *
     * @return \Generated\Shared\Transfer\DiscountCustomMessageTransfer[]
     */
    public function findDiscountCustomMessagesByIdDiscount(int $idDiscount): array;

    /**
     * @param \Generated\Shared\Transfer\DiscountTransfer $discountTransfer
     *
     * @return \Generated\Shared\Transfer\DiscountCustomMessageTransfer|null
     */
    public function findCustomMessageByIdDiscountAndCurrentLocale(DiscountTransfer $discountTransfer): ?DiscountCustomMessageTransfer;
}
