<?php

namespace FondOfSpryker\Zed\DiscountCustomMessages\Business;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\DiscountConfiguratorTransfer;

class DiscountCustomMessagesFacadeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\DiscountCustomMessages\Business\DiscountCustomMessagesBusinessFactory
     */
    protected $factoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\DiscountConfiguratorTransfer
     */
    protected $discountConfiguratorTransferMock;

    /**
     * @var DiscountCustomMessagesFacadeInterface
     */
    protected $facade;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->discountConfiguratorTransferMock = $this->getMockBuilder(DiscountConfiguratorTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factoryMock = $this->getMockBuilder(DiscountCustomMessagesBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facade = new DiscountCustomMessagesFacade();
        $this->facade->setFactory($this->factoryMock);
    }

    /**
     * @return void
     */
    public function testExpandDefaultDiscountConfigurator(): void
    {
        $this->factoryMock->expects($this->once())
            ->method('createDiscountCustomMessagesExpander');

        $this->facade->expandDefaultDiscountConfigurator($this->discountConfiguratorTransferMock);
    }

    /**
     * @return void
     */
    /*public function testExpandDiscountConfigurationWithCustomMessages(): void
    {
        $this->factoryMock->expects($this->once())
            ->method('createDiscountCustomMessagesReader');

        $this->facade->expandDiscountConfigurationWithCustomMessages($this->discountConfiguratorTransferMock);
    }*/

    /**
     * @return void
     */
    public function testPostUpdate(): void
    {
        $this->factoryMock->expects($this->once())
            ->method('createDiscountCustomMessagesWriter');

        $this->facade->postUpdate($this->discountConfiguratorTransferMock);
    }

    /**
     * @return void
     */
    public function testCreateDiscountCustomMessages(): void
    {
        $this->factoryMock->expects($this->once())
            ->method('createDiscountCustomMessagesWriter');

        $this->facade->createDiscountCustomMessages($this->discountConfiguratorTransferMock);
    }
}
