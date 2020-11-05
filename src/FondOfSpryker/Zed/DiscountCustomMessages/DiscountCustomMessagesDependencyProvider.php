<?php

namespace FondOfSpryker\Zed\DiscountCustomMessages;

use FondOfSpryker\Zed\DiscountCustomMessages\Dependency\Facade\DiscountCustomMessageToLocaleFacadeBridge;
use FondOfSpryker\Zed\DiscountCustomMessages\Dependency\Facade\DiscountCustomMessageToMessengerFacadeBridge;
use FondOfSpryker\Zed\DiscountCustomMessages\Dependency\Query\DiscountCustomMessagesToLocaleQueryContainerBridge;
use Orm\Zed\DiscountDiscountMessage\Persistence\FobDiscountCustomMessageQuery;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class DiscountCustomMessagesDependencyProvider extends AbstractBundleDependencyProvider
{
    public const FACADE_LOCALE = 'FACADE_LOCALE';
    public const FACADE_MESSENGER = 'FACADE_MESSENGER';

    public const QUERY_LOCALE = 'QUERY_LOCALE';
    public const QUERY_DISCOUNT_CUSTOM_MESSAGE = 'QUERY_DISCOUNT_CUSTOM_MESSAGE';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function providePersistenceLayerDependencies(Container $container): Container
    {
        $container = $this->addDiscountCustomMessageQuery($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideCommunicationLayerDependencies(Container $container): Container
    {
        $container = $this->addLocaleFacade($container);
        $container = $this->addMessengerFacade($container);
        $container = $this->addLocaleQueryContainer($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container)
    {
        $container = $this->addLocaleFacade($container);
        $container = $this->addMessengerFacade($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addLocaleFacade(Container $container): Container
    {
        $container->set(static::FACADE_LOCALE, static function (Container $container) {
            return new DiscountCustomMessageToLocaleFacadeBridge($container->getLocator()->locale()->facade());
        });

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addMessengerFacade(Container $container): Container
    {
        $container->set(static::FACADE_MESSENGER, static function (Container $container) {
            return new DiscountCustomMessageToMessengerFacadeBridge($container->getLocator()->messenger()->facade());
        });

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addLocaleQueryContainer(Container $container): Container
    {
        $container->set(static::QUERY_LOCALE, static function (Container $container) {
            return new DiscountCustomMessagesToLocaleQueryContainerBridge(
                $container->getLocator()->locale()->queryContainer()
            );
        });

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addDiscountCustomMessageQuery(Container $container): Container
    {
        $container->set(static::QUERY_DISCOUNT_CUSTOM_MESSAGE, static function (Container $container) {
            return FobDiscountCustomMessageQuery::create();
        });

        return $container;
    }
}
