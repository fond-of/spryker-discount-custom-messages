<?php

namespace FondOfSpryker\Zed\DiscountCustomMessages\Business;

use FondOfSpryker\Zed\DiscountCustomMessages\Business\Model\DiscountCustomMessagesReader;
use FondOfSpryker\Zed\DiscountCustomMessages\Business\Model\DiscountCustomMessagesReaderInterface;
use FondOfSpryker\Zed\DiscountCustomMessages\Business\Model\Mapper\DiscountCustomMessagesMapper;
use FondOfSpryker\Zed\DiscountCustomMessages\Business\Model\Mapper\DiscountCustomMessagesMapperInterface;
use FondOfSpryker\Zed\DiscountCustomMessages\DiscountCustomMessagesDependencyProvider;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfSpryker\Zed\DiscountCustomMessages\Persistence\DiscountCustomMessagesQueryContainerInterface getQueryContainer()
 */
class DiscountCustomMessagesBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfSpryker\Zed\DiscountCustomMessages\Business\Model\DiscountCustomMessagesReaderInterface
     */
    public function createDiscountCustomMessagesReader(): DiscountCustomMessagesReaderInterface
    {
        return new DiscountCustomMessagesReader(
            $this->getQueryContainer(),
            $this->createDiscountCustomMessagesMapper(),
            $this->getProvidedDependency(DiscountCustomMessagesDependencyProvider::FACADE_LOCALE)
        );
    }

    /**
     * @return \FondOfSpryker\Zed\DiscountCustomMessages\Business\Model\Mapper\DiscountCustomMessagesMapperInterface
     */
    public function createDiscountCustomMessagesMapper(): DiscountCustomMessagesMapperInterface
    {
        return new DiscountCustomMessagesMapper(
            $this->getProvidedDependency(DiscountCustomMessagesDependencyProvider::FACADE_LOCALE)
        );
    }
}
