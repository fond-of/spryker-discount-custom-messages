<?php

namespace FondOfSpryker\Zed\DiscountCustomMessages\Business;

use FondOfSpryker\Zed\DiscountCustomMessages\Business\Model\DiscountCustomMessagesExpander;
use FondOfSpryker\Zed\DiscountCustomMessages\Business\Model\DiscountCustomMessagesExpanderInterface;
use FondOfSpryker\Zed\DiscountCustomMessages\Business\Model\DiscountCustomMessagesReader;
use FondOfSpryker\Zed\DiscountCustomMessages\Business\Model\DiscountCustomMessagesReaderInterface;
use FondOfSpryker\Zed\DiscountCustomMessages\Business\Model\DiscountCustomMessagesWriter;
use FondOfSpryker\Zed\DiscountCustomMessages\Business\Model\DiscountCustomMessagesWriterInterface;
use FondOfSpryker\Zed\DiscountCustomMessages\Dependency\Facade\DiscountCustomMessageToLocaleFacadeInterface;
use FondOfSpryker\Zed\DiscountCustomMessages\Dependency\Facade\DiscountCustomMessageToMessengerFacadeInterface;
use FondOfSpryker\Zed\DiscountCustomMessages\DiscountCustomMessagesDependencyProvider;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfSpryker\Zed\DiscountCustomMessages\Persistence\DiscountCustomMessagesRepositoryInterface getRepository()
 * @method \FondOfSpryker\Zed\DiscountCustomMessages\Persistence\DiscountCustomMessagesEntityManagerInterface getEntityManager()
 * @method \FondOfSpryker\Zed\DiscountCustomMessages\DiscountCustomMessagesConfig getConfig()
 */
class DiscountCustomMessagesBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfSpryker\Zed\DiscountCustomMessages\Business\Model\DiscountCustomMessagesExpanderInterface
     */
    public function createDiscountCustomMessagesExpander(): DiscountCustomMessagesExpanderInterface
    {
        return new DiscountCustomMessagesExpander($this->getLocaleFacade());
    }

    /**
     * @return \FondOfSpryker\Zed\DiscountCustomMessages\Business\Model\DiscountCustomMessagesReaderInterface
     */
    public function createDiscountCustomMessagesReader(): DiscountCustomMessagesReaderInterface
    {
        return new DiscountCustomMessagesReader(
            $this->getRepository(),
            $this->getLocaleFacade()
        );
    }

    /**
     * @return \FondOfSpryker\Zed\DiscountCustomMessages\Business\Model\DiscountCustomMessagesWriterInterface
     */
    public function createDiscountCustomMessagesWriter(): DiscountCustomMessagesWriterInterface
    {
        return new DiscountCustomMessagesWriter(
            $this->getEntityManager(),
            $this->getLocaleFacade()
        );
    }

    /**
     * @return \FondOfSpryker\Zed\DiscountCustomMessages\Dependency\Facade\DiscountCustomMessageToMessengerFacadeInterface
     */
    public function getMessengerFacade(): DiscountCustomMessageToMessengerFacadeInterface
    {
        return $this->getProvidedDependency(DiscountCustomMessagesDependencyProvider::FACADE_MESSENGER);
    }

    /**
     * @param \Everon\Component\Factory\Dependency\Container $container
     *
     * @return \FondOfSpryker\Zed\DiscountCustomMessages\Dependency\Facade\DiscountCustomMessageToLocaleFacadeInterface
     */
    public function getLocaleFacade(): DiscountCustomMessageToLocaleFacadeInterface
    {
        return $this->getProvidedDependency(DiscountCustomMessagesDependencyProvider::FACADE_LOCALE);
    }
}
