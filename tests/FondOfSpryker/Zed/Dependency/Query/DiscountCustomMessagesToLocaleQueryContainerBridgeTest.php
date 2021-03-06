<?php

namespace FondOfSpryker\Zed\DiscountCustomMessages\Dependency\Query;

use Codeception\Test\Unit;
use Orm\Zed\Locale\Persistence\SpyLocaleQuery;
use Spryker\Zed\Locale\Persistence\LocaleQueryContainerInterface;

class DiscountCustomMessagesToLocaleQueryContainerBridgeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Locale\Persistence\LocaleQueryContainerInterface
     */
    protected $localeQueryContainerMock;

    /**
     * @var DiscountCustomMessagesToLocaleQueryContainerInterface
     */
    protected $bridge;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Orm\Zed\Locale\Persistence\SpyLocaleQuery
     */
    protected $spyLocaleQuery;

    /**
     * @retun void
     *
     * @return void
     */
    protected function _before(): void
    {
        $this->localeQueryContainerMock = $this->getMockBuilder(LocaleQueryContainerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->spyLocaleQuery = $this->getMockBuilder(SpyLocaleQuery::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->bridge = new DiscountCustomMessagesToLocaleQueryContainerBridge($this->localeQueryContainerMock);
    }

    /**
     * @retun void
     *
     * @return void
     */
    public function testQueryLocaleByName(): void
    {
        $this->localeQueryContainerMock->expects($this->once())
            ->method('queryLocaleByName')
            ->with('LOCALE_NAME')
            ->willReturn($this->spyLocaleQuery);

        $this->bridge->queryLocaleByName('LOCALE_NAME');
    }
}
