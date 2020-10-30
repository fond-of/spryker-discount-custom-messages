<?php

namespace FondOfSpryker\Zed\DiscountCustomMessages\Persistence;

use Orm\Zed\DiscountDiscountMessage\Persistence\FobDiscountCustomMessage;
use Spryker\Zed\Kernel\Persistence\AbstractQueryContainer;

/**
 * @method \FondOfSpryker\Zed\DiscountCustomMessages\Persistence\DiscountCustomMessagesPersistenceFactory getFactory()
 * @method \Spryker\Zed\DiscountPromotion\DiscountPromotionConfig getConfig()
 */
class DiscountCustomMessagesQueryContainer extends AbstractQueryContainer implements DiscountCustomMessagesQueryContainerInterface
{
    /**
     * @param int $idDiscount
     *
     * @return mixed|\Orm\Zed\DiscountDiscountMessage\Persistence\FobDiscountCustomMessage[]|\Propel\Runtime\Collection\ObjectCollection
     */
    public function queryDiscountCustomMessagesByIdDiscount(int $idDiscount)
    {
        return $this->getFactory()
            ->createDiscountCustomMessagesQuery()
            ->findByFkDiscount($idDiscount);
    }

    /**
     * @param int $idDiscountCustomMessage
     * @param int $idDiscount
     *
     * @return \Orm\Zed\DiscountDiscountMessage\Persistence\FobDiscountCustomMessage|null
     */
    public function queryDiscountCustomMessageByIdAndIdDiscount(int $idDiscountCustomMessage, int $idDiscount): ?FobDiscountCustomMessage
    {
        return $this->getFactory()
            ->createDiscountCustomMessagesQuery()
            ->filterByIdDiscountCustomMessage($idDiscountCustomMessage)
            ->filterByFkDiscount($idDiscount)
            ->findOne();
    }
}
