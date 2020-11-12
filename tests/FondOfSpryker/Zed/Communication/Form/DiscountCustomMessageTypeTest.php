<?php

namespace FondOfSpryker\Zed\DiscountCustomMessages\Communication\Form;

use Codeception\Test\Unit;
use org\bovigo\vfs\vfsStream;
use Spryker\Shared\Config\Config;
use Symfony\Component\Form\FormBuilder;

class DiscountCustomMessageTypeTest extends Unit
{
    /**
     * @return void
     */
    protected function _before()
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
    }

    /**
     * @return void
     */
    public function testBuildForm()
    {
        $builder = $this->getMockBuilder(FormBuilder::class)
            ->disableOriginalConstructor()
            ->getMock();

        $plugin = new DiscountCustomMessageType();

        $builder->expects($this->exactly(3))
            ->method('add');

        $plugin->buildForm($builder, []);
    }
}
