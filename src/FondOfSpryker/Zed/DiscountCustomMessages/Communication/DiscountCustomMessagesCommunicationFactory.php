<?php

namespace FondOfSpryker\Zed\DiscountCustomMessages\Communication;

use FondOfSpryker\Zed\DiscountCustomMessages\Dependency\Facade\DiscountCustomMessageToLocaleFacadeInterface;
use FondOfSpryker\Zed\DiscountCustomMessages\DiscountCustomMessagesDependencyProvider;
use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;

class DiscountCustomMessagesCommunicationFactory extends AbstractCommunicationFactory
{
    /**
     * @return DiscountCustomMessageToLocaleFacadeInterface
     *
     * @throws \Spryker\Zed\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    public function getLocaleFacade(): DiscountCustomMessageToLocaleFacadeInterface
    {
        return $this->getProvidedDependency(DiscountCustomMessagesDependencyProvider::FACADE_LOCALE);
    }
}
