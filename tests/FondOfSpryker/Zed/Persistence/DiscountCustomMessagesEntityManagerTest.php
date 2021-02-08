<?php

namespace FondOfSpryker\Zed\DiscountCustomMessages\Persistence;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\DiscountCustomMessages\Persistence\Propel\Mapper\DiscountCustomMessageMapperInterface;
use Generated\Shared\Transfer\DiscountCustomMessageTransfer;
use org\bovigo\vfs\vfsStream;
use Orm\Zed\DiscountDiscountMessage\Persistence\FooDiscountCustomMessage;
use Orm\Zed\DiscountDiscountMessage\Persistence\FooDiscountCustomMessageQuery;
use Spryker\Shared\Config\Config;

class DiscountCustomMessagesEntityManagerTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\DiscountCustomMessageTransfer
     */
    protected $discountCustomMessagesTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|DiscountCustomMessagesPersistenceFactory
     */
    protected $factoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\DiscountCustomMessages\Persistence\Propel\Mapper\DiscountCustomMessageMapperInterface
     */
    protected $discountCustomMessageMapperMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Orm\Zed\DiscountDiscountMessage\Persistence\FooDiscountCustomMessage
     */
    protected $discountCustomMessageEntityMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Orm\Zed\DiscountDiscountMessage\Persistence\FooDiscountCustomMessageQuery
     */
    protected $discountCustomMessageQueryMock;

    /**
     * @var DiscountCustomMessagesEntityManagerInterface
     */
    protected $entityManager;

    /**
     * @return void
     */
    protected function _before(): void
    {
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

        $this->factoryMock = $this->getMockBuilder(DiscountCustomMessagesPersistenceFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->discountCustomMessagesTransferMock = $this->getMockBuilder(DiscountCustomMessageTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->discountCustomMessageMapperMock = $this->getMockBuilder(DiscountCustomMessageMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->discountCustomMessageEntityMock = $this->getMockBuilder(FooDiscountCustomMessage::class)
            ->disableOriginalConstructor()
            ->setMethods(['save', 'formArray'])
            ->getMock();

        $this->discountCustomMessageQueryMock = $this->getMockBuilder(FooDiscountCustomMessageQuery::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->entityManager = new DiscountCustomMessagesEntityManager();
    }

    /**
     * @return void
     */
    public function testCreate(): void
    {
    }

    /**
     * @return void
     */
    public function testUpdate(): void
    {
    }
}
