<?php

namespace FondOfSpryker\Zed\DiscountCustomMessages\Persistence;

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
     * @return mixed|\Orm\Zed\DiscountLocalizedMessages\Persistence\FobDiscountLocalizedMessages[]|\Propel\Runtime\Collection\ObjectCollection
     */
    public function queryDiscountCustomMessagesByIdDiscount(int $idDiscount)
    {
        return $this->getFactory()
            ->createDiscountPromotionQuery()
            ->findByFkDiscount($idDiscount);
    }
}
