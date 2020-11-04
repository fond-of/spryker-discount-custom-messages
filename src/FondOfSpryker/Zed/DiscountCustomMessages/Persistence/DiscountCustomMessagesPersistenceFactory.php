<?php

namespace FondOfSpryker\Zed\DiscountCustomMessages\Persistence;

use Orm\Zed\DiscountDiscountMessage\Persistence\FobDiscountCustomMessageQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @method \FondOfSpryker\Zed\DiscountCustomMessages\Persistence\DiscountCustomMessagesQueryContainerInterface getQueryContainer()
 * @method \FondOfSpryker\Zed\DiscountCustomMessages\DiscountCustomMessagesConfig getConfig()
 */
class DiscountCustomMessagesPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\DiscountDiscountMessage\Persistence\FobDiscountCustomMessageQuery
     */
    public function createDiscountCustomMessagesQuery(): FobDiscountCustomMessageQuery
    {
        return FobDiscountCustomMessageQuery::create();
    }
}
