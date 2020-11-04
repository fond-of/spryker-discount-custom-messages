<?php

namespace FondOfSpryker\Zed\DiscountCustomMessages\Dependency\Query;

use Orm\Zed\Locale\Persistence\SpyLocaleQuery;

interface DiscountCustomMessagesToLocaleQueryContainerInterface
{
    /**
     * @param string $localeName
     *
     * @return \Orm\Zed\Locale\Persistence\SpyLocaleQuery
     */
    public function queryLocaleByName(string $localeName): SpyLocaleQuery;
}
