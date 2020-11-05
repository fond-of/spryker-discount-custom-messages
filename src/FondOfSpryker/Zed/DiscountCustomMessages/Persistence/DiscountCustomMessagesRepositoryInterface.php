<?php

namespace FondOfSpryker\Zed\DiscountCustomMessages\Persistence;

use Generated\Shared\Transfer\DiscountCustomMessageTransfer;
use Orm\Zed\DiscountDiscountMessage\Persistence\FobDiscountCustomMessage;

interface DiscountCustomMessagesRepositoryInterface
{
    /**
     * @param int $idDiscount
     *
     * @return DiscountCustomMessageTransfer[]
     */
    public function findDiscountCustomMessagesByIdDiscount(int $idDiscount): array;

    /**
     * @param int $idDiscountCustomMessage
     * @param int $idDiscount
     *
     * @return DiscountCustomMessageTransfer|null
     */
    public function findDiscountCustomMessageByIdAndIdDiscount(int $idDiscountCustomMessage, int $idDiscount): ?DiscountCustomMessageTransfer;

    /**
     * @param int $idDiscount
     * @param int $idLocale
     *
     * @return DiscountCustomMessageTransfer|null
     */
    public function findDiscountCustomMessageByIdDiscountAndIdLocale(int $idDiscount, int $idLocale): ?DiscountCustomMessageTransfer;

    /**
     * @param int $idDiscountCustomMessage
     *
     * @return \Orm\Zed\DiscountDiscountMessage\Persistence\FobDiscountCustomMessage|null
     */
    public function findDiscountCustomMessageById(int $idDiscountCustomMessage): ?DiscountCustomMessageTransfer;
}
