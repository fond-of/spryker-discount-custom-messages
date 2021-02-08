<?php

namespace FondOfSpryker\Zed\DiscountCustomMessages\Dependency\Query;

use Orm\Zed\Locale\Persistence\SpyLocaleQuery;
use Spryker\Zed\Locale\Persistence\LocaleQueryContainerInterface;

class DiscountCustomMessagesToLocaleQueryContainerBridge implements DiscountCustomMessagesToLocaleQueryContainerInterface
{
    /**
     * @var \Spryker\Zed\Locale\Persistence\LocaleQueryContainerInterface
     */
    protected $localeQueryContainer;

    /**
     * @param \Spryker\Zed\Locale\Persistence\LocaleQueryContainerInterface $localeQueryContainer
     */
    public function __construct(LocaleQueryContainerInterface $localeQueryContainer)
    {
        $this->localeQueryContainer = $localeQueryContainer;
    }

    /**
     * @param string $localeName
     *
     * @return \Orm\Zed\Locale\Persistence\SpyLocaleQuery
     */
    public function queryLocaleByName(string $localeName): SpyLocaleQuery
    {
        return $this->localeQueryContainer->queryLocaleByName($localeName);
    }
}
