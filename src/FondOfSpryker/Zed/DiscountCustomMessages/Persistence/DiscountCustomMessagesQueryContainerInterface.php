<?php

namespace FondOfSpryker\Zed\DiscountCustomMessages\Persistence;

use Orm\Zed\DiscountDiscountMessage\Persistence\FobDiscountCustomMessage;

interface DiscountCustomMessagesQueryContainerInterface
{
    /**
     * @param int $idDiscount
     *
     * @return mixed|\Orm\Zed\DiscountDiscountMessage\Persistence\FobDiscountCustomMessage[]|\Propel\Runtime\Collection\ObjectCollection
     */
    public function queryDiscountCustomMessagesByIdDiscount(int $idDiscount);

    /**
     * @param int $idDiscountCustomMessage
     * @param int $idDiscount
     *
     * @return \Orm\Zed\DiscountDiscountMessage\Persistence\FobDiscountCustomMessage|null
     */
    public function queryDiscountCustomMessageByIdAndIdDiscount(int $idDiscountCustomMessage, int $idDiscount): ?FobDiscountCustomMessage;
}
