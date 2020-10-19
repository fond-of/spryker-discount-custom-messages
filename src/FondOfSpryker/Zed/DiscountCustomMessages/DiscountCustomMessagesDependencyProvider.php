<?php

namespace FondOfSpryker\Zed\DiscountCustomMessages;

use FondOfSpryker\Zed\DiscountCustomMessages\Dependency\Facade\DiscountCustomMessageToLocaleFacadeBridge;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class DiscountCustomMessagesDependencyProvider extends AbstractBundleDependencyProvider
{
    public const FACADE_LOCALE = 'FACADE_LOCALE';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function providePersistenceLayerDependencies(Container $container): Container
    {
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

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addLocaleFacade(Container $container): Container
    {
        $container->set(static::FACADE_LOCALE, function (Container $container) {
            return new DiscountCustomMessageToLocaleFacadeBridge($container->getLocator()->locale()->facade());
        });

        return $container;
    }
}
