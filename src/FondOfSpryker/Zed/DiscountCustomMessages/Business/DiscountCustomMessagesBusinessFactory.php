<?php

namespace FondOfSpryker\Zed\DiscountCustomMessages\Business;

use Everon\Component\Factory\Dependency\Container;
use FondOfSpryker\Zed\DiscountCustomMessages\Business\Model\DiscountCustomMessagesExpander;
use FondOfSpryker\Zed\DiscountCustomMessages\Business\Model\DiscountCustomMessagesExpanderInterface;
use FondOfSpryker\Zed\DiscountCustomMessages\Business\Model\DiscountCustomMessagesReader;
use FondOfSpryker\Zed\DiscountCustomMessages\Business\Model\DiscountCustomMessagesReaderInterface;
use FondOfSpryker\Zed\DiscountCustomMessages\Business\Model\DiscountCustomMessagesWriter;
use FondOfSpryker\Zed\DiscountCustomMessages\Business\Model\DiscountCustomMessagesWriterInterface;
use FondOfSpryker\Zed\DiscountCustomMessages\Business\Model\Mapper\DiscountCustomMessagesMapper;
use FondOfSpryker\Zed\DiscountCustomMessages\Business\Model\Mapper\DiscountCustomMessagesMapperInterface;
use FondOfSpryker\Zed\DiscountCustomMessages\Dependency\Facade\DiscountCustomMessageToLocaleFacadeInterface;
use FondOfSpryker\Zed\DiscountCustomMessages\Dependency\Facade\DiscountCustomMessageToMessengerFacadeInterface;
use FondOfSpryker\Zed\DiscountCustomMessages\DiscountCustomMessagesDependencyProvider;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfSpryker\Zed\DiscountCustomMessages\Persistence\DiscountCustomMessagesRepositoryInterface getRepository()
 * @method \FondOfSpryker\Zed\DiscountCustomMessages\Persistence\DiscountCustomMessagesEntityManagerInterface getEntityManager()
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
            $this->createDiscountCustomMessagesMapper(),
            $this->getLocaleFacade()
        );
    }

    /**
     * @return \FondOfSpryker\Zed\DiscountCustomMessages\Business\Model\DiscountCustomMessagesWriterInterface
     */
    public function createDiscountCustomMessagesWriter(): DiscountCustomMessagesWriterInterface
    {
        return new DiscountCustomMessagesWriter(
            $this->getRepository(),
            $this->createDiscountCustomMessagesMapper(),
            $this->getLocaleFacade(),
            $this->getEntityManager()
        );
    }

    /**
     * @return \FondOfSpryker\Zed\DiscountCustomMessages\Business\Model\Mapper\DiscountCustomMessagesMapperInterface
     */
    public function createDiscountCustomMessagesMapper(): DiscountCustomMessagesMapperInterface
    {
        return new DiscountCustomMessagesMapper($this->getLocaleFacade());
    }

    /**
     * @return \FondOfSpryker\Zed\DiscountCustomMessages\Dependency\Facade\DiscountCustomMessageToMessengerFacadeInterface
     */
    public function getMessengerFacade(): DiscountCustomMessageToMessengerFacadeInterface
    {
        return $this->getProvidedDependency(DiscountCustomMessagesDependencyProvider::FACADE_MESSENGER);
    }

    /**
     * @param Container $container
     * @return DiscountCustomMessageToLocaleFacadeInterface
     * @throws \Spryker\Zed\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    public function getLocaleFacade(): DiscountCustomMessageToLocaleFacadeInterface
    {
        return $this->getProvidedDependency(DiscountCustomMessagesDependencyProvider::FACADE_LOCALE);
    }
}
