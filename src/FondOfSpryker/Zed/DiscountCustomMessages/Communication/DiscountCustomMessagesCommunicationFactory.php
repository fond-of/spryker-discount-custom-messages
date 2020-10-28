<?php

namespace FondOfSpryker\Zed\DiscountCustomMessages\Communication;

use FondOfSpryker\Zed\DiscountCustomMessages\Dependency\Facade\DiscountCustomMessageToLocaleFacadeInterface;
use FondOfSpryker\Zed\DiscountCustomMessages\DiscountCustomMessagesDependencyProvider;
use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;

/**
 * @method \FondOfSpryker\Zed\DiscountCustomMessages\Business\DiscountCustomMessagesFacadeInterface getFacade()
 * @method \FondOfSpryker\Zed\DiscountCustomMessages\Persistence\DiscountCustomMessagesQueryContainerInterface getQueryContainer()
 */
class DiscountCustomMessagesCommunicationFactory extends AbstractCommunicationFactory
{
    /**
     * @return \FondOfSpryker\Zed\DiscountCustomMessages\Dependency\Facade\DiscountCustomMessageToLocaleFacadeInterface
     */
    public function getLocaleFacade(): DiscountCustomMessageToLocaleFacadeInterface
    {
        return $this->getProvidedDependency(DiscountCustomMessagesDependencyProvider::FACADE_LOCALE);
    }
}
