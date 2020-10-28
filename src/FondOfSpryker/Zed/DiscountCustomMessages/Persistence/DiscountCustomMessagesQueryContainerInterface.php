<?php

namespace FondOfSpryker\Zed\DiscountCustomMessages\Persistence;

interface DiscountCustomMessagesQueryContainerInterface
{
    /**
     * @param int $idDiscount
     *
     * @return mixed|\Orm\Zed\DiscountLocalizedMessages\Persistence\FobDiscountLocalizedMessages[]|\Propel\Runtime\Collection\ObjectCollection
     */
    public function queryDiscountCustomMessagesByIdDiscount(int $idDiscount);
}
