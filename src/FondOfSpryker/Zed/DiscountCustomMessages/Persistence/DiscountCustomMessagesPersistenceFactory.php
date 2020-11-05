<?php

namespace FondOfSpryker\Zed\DiscountCustomMessages\Persistence;

use FondOfSpryker\Zed\DiscountCustomMessages\DiscountCustomMessagesDependencyProvider;
use FondOfSpryker\Zed\DiscountCustomMessages\Persistence\Propel\Mapper\DiscountCustomMessageMapper;
use FondOfSpryker\Zed\DiscountCustomMessages\Persistence\Propel\Mapper\DiscountCustomMessageMapperInterface;
use Orm\Zed\DiscountDiscountMessage\Persistence\FobDiscountCustomMessageQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

class DiscountCustomMessagesPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\DiscountDiscountMessage\Persistence\FobDiscountCustomMessageQuery
     */
    public function getDiscountCustomMessagesQuery(): FobDiscountCustomMessageQuery
    {
        return $this->getProvidedDependency(DiscountCustomMessagesDependencyProvider::QUERY_DISCOUNT_CUSTOM_MESSAGE);
    }

    /**
     * @return DiscountCustomMessageMapperInterface
     */
    public function createDiscountCustomMessageMapper(): DiscountCustomMessageMapperInterface
    {
        return new DiscountCustomMessageMapper();
    }
}
