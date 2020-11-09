<?php

namespace FondOfSpryker\Zed\DiscountCustomMessages\Dependency\Facade;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\LocaleTransfer;
use Spryker\Zed\Locale\Business\LocaleFacadeInterface;

class DiscountCustomMessageToLocaleFacadeBridgeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\DiscountCustomMessages\Dependency\Facade\DiscountCustomMessageToLocaleFacadeInterface
     */
    protected $localeFacadeMock;

    /**
     * @var DiscountCustomMessageToLocaleFacadeInterface
     */
    protected $bridge;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->localeFacadeMock = $this->getMockBuilder(LocaleFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->bridge = new DiscountCustomMessageToLocaleFacadeBridge($this->localeFacadeMock);
    }

    /**
     * @return void
     */
    public function testGetCurrentLocale(): void
    {
        $this->localeFacadeMock->expects($this->once())
            ->method('getCurrentLocale')
            ->willReturn(new LocaleTransfer());

        $this->bridge->getCurrentLocale();
    }

    /**
     * @return void
     */
    public function testGetLocaleCollection(): void
    {
        $this->localeFacadeMock->expects($this->once())
            ->method('getLocaleCollection')
            ->willReturn([new LocaleTransfer()]);

        $this->bridge->getLocaleCollection();
    }

    /**
     * @return void
     */
    public function testGetLocaleById(): void
    {
        $this->localeFacadeMock->expects($this->once())
            ->method('getLocaleById')
            ->with(1)
            ->willReturn(new LocaleTransfer());

        $this->bridge->getLocaleById(1);
    }
}
