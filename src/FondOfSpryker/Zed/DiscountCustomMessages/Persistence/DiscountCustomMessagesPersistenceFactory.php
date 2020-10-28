<?php

namespace FondOfSpryker\Zed\DiscountCustomMessages\Persistence;

use Orm\Zed\DiscountLocalizedMessages\Persistence\FobDiscountLocalizedMessagesQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @method \FondOfSpryker\Zed\DiscountCustomMessages\Persistence\DiscountCustomMessagesQueryContainerInterface getQueryContainer()
 */
class DiscountCustomMessagesPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\DiscountLocalizedMessages\Persistence\FobDiscountLocalizedMessagesQuery
     */
    public function createDiscountPromotionQuery(): FobDiscountLocalizedMessagesQuery
    {
        return FobDiscountLocalizedMessagesQuery::create();
    }
}
