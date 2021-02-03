<?php

namespace FondOfSpryker\Zed\DiscountCustomMessages\Persistence;

use Generated\Shared\Transfer\DiscountCustomMessageTransfer;

interface DiscountCustomMessagesRepositoryInterface
{
    /**
     * @param int $idDiscount
     *
     * @return \Generated\Shared\Transfer\DiscountCustomMessageTransfer[]
     */
    public function findDiscountCustomMessagesByIdDiscount(int $idDiscount): array;

    /**
     * @param int $idDiscountCustomMessage
     * @param int $idDiscount
     *
     * @return \Generated\Shared\Transfer\DiscountCustomMessageTransfer|null
     */
    public function findDiscountCustomMessageByIdAndIdDiscount(int $idDiscountCustomMessage, int $idDiscount): ?DiscountCustomMessageTransfer;

    /**
     * @param int $idDiscount
     * @param int $idLocale
     *
     * @return \Generated\Shared\Transfer\DiscountCustomMessageTransfer|null
     */
    public function findDiscountCustomMessageByIdDiscountAndIdLocale(int $idDiscount, int $idLocale): ?DiscountCustomMessageTransfer;

    /**
     * @param int $idDiscountCustomMessage
     *
     * @return \Orm\Zed\DiscountDiscountMessage\Persistence\FooDiscountCustomMessage|null
     */
    public function findDiscountCustomMessageById(int $idDiscountCustomMessage): ?DiscountCustomMessageTransfer;
}
