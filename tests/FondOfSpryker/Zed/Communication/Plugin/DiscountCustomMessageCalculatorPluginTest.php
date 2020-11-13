<?php

namespace FondOfSpryker\Zed\DiscountCustomMessages\Communication\Plugin;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\DiscountCustomMessages\Business\Messenger\DiscountCustomMessagesMessenger;
use FondOfSpryker\Zed\DiscountCustomMessages\Communication\DiscountCustomMessagesCommunicationFactory;
use Generated\Shared\Transfer\DiscountTransfer;
use org\bovigo\vfs\vfsStream;
use Spryker\Shared\Config\Config;

class DiscountCustomMessageCalculatorPluginTest extends Unit
{
    /**
     * @var DiscountCustomMessageCalculatorPlugin
     */
    protected $plugin;

    /**
     * @var \Generated\Shared\Transfer\DiscountTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $discountTransferMock;

    /**
     * @var \FondOfSpryker\Zed\DiscountCustomMessages\Communication\DiscountCustomMessagesCommunicationFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $factoryMock;

    /**
     * @var \FondOfSpryker\Zed\DiscountCustomMessages\Business\Messenger\DiscountCustomMessagesMessenger|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $discountCustomMessagesMessengerMock;

    /**
     * @retun void
     *
     * @return void
     */
    protected function _before(): void
    {
        $this->discountTransferMock = $this->getMockBuilder(DiscountTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factoryMock = $this->getMockBuilder(DiscountCustomMessagesCommunicationFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->discountCustomMessagesMessengerMock = $this->getMockBuilder(DiscountCustomMessagesMessenger::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new DiscountCustomMessageCalculatorPlugin();
        $this->plugin->setFactory($this->factoryMock);

        $this->vfsStreamDirectory = vfsStream::setup('root', null, [
            'config' => [
                'Shared' => [
                    'stores.php' => file_get_contents(codecept_data_dir('stores.php')),
                    'config_default.php' => file_get_contents(codecept_data_dir('empty_config_default.php')),
                ],
            ],
        ]);

        $fileUrl = vfsStream::url('root/config/Shared/config_default.php');
        $newFileContent = file_get_contents(codecept_data_dir('config_default.php'));
        file_put_contents($fileUrl, $newFileContent);
        Config::getInstance()->init();
    }

    /**
     * @retun void
     *
     * @return void
     */
    public function testAddSuccessMessage(): void
    {
        $this->factoryMock->expects($this->once())
            ->method('createDiscountCustomMessagesMessenger')
            ->willReturn($this->discountCustomMessagesMessengerMock);

        $this->discountCustomMessagesMessengerMock->expects($this->once())
            ->method('addSuccessMessageFromDiscountTransfer');

        $this->plugin->addSuccessMessageFromDiscountTransfer($this->discountTransferMock);
    }

    /**
     * @return void
     */
    public function testAddSuccessMessageFromString(): void
    {
        $this->factoryMock->expects($this->once())
            ->method('createDiscountCustomMessagesMessenger')
            ->willReturn($this->discountCustomMessagesMessengerMock);

        $this->discountCustomMessagesMessengerMock->expects($this->once())
            ->method('addSuccessMessageFromString');

        $this->plugin->addSuccessMessageFromString('foo bar');
    }

    /**
     * @return void
     */
    public function testAddErrorMessage(): void
    {
        $this->factoryMock->expects($this->once())
            ->method('createDiscountCustomMessagesMessenger')
            ->willReturn($this->discountCustomMessagesMessengerMock);

        $this->discountCustomMessagesMessengerMock->expects($this->once())
            ->method('addErrorMessageFromDiscountTransfer')
            ->with($this->discountTransferMock);

        $this->plugin->addErrorMessageFromDiscountTransfer($this->discountTransferMock);
    }

    /**
     * @return void
     */
    public function testAddVoucherNotFoundErrorMessage(): void
    {
        $this->factoryMock->expects($this->once())
            ->method('createDiscountCustomMessagesMessenger')
            ->willReturn($this->discountCustomMessagesMessengerMock);

        $this->discountCustomMessagesMessengerMock->expects($this->once())
            ->method('addVoucherNotFoundErrorMessage');

        $this->plugin->addVoucherNotFoundErrorMessage();
    }
}
