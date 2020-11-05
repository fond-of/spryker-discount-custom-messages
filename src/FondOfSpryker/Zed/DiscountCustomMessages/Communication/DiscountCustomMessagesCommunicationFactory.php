<?php

namespace FondOfSpryker\Zed\DiscountCustomMessages\Communication;

use FondOfSpryker\Zed\DiscountCustomMessages\Business\Messenger\DiscountCustomMessagesMessenger;
use FondOfSpryker\Zed\DiscountCustomMessages\Business\Messenger\DiscountCustomMessagesMessengerInterface;
use FondOfSpryker\Zed\DiscountCustomMessages\Business\Model\DiscountCustomMessagesReader;
use FondOfSpryker\Zed\DiscountCustomMessages\Business\Model\DiscountCustomMessagesReaderInterface;
use FondOfSpryker\Zed\DiscountCustomMessages\Business\Model\Mapper\DiscountCustomMessagesMapper;
use FondOfSpryker\Zed\DiscountCustomMessages\Business\Model\Mapper\DiscountCustomMessagesMapperInterface;
use FondOfSpryker\Zed\DiscountCustomMessages\Dependency\Facade\DiscountCustomMessageToLocaleFacadeInterface;
use FondOfSpryker\Zed\DiscountCustomMessages\Dependency\Facade\DiscountCustomMessageToMessengerFacadeInterface;
use FondOfSpryker\Zed\DiscountCustomMessages\Dependency\Query\DiscountCustomMessagesToLocaleQueryContainerInterface;
use FondOfSpryker\Zed\DiscountCustomMessages\DiscountCustomMessagesDependencyProvider;
use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;

/**
 * @method \FondOfSpryker\Zed\DiscountCustomMessages\DiscountCustomMessagesConfig getConfig()
 * @method \FondOfSpryker\Zed\DiscountCustomMessages\Persistence\DiscountCustomMessagesRepositoryInterface getRepository()
 */
class DiscountCustomMessagesCommunicationFactory extends AbstractCommunicationFactory
{
    /**
     * @return \FondOfSpryker\Zed\DiscountCustomMessages\Business\Messenger\DiscountCustomMessagesMessengerInterface
     */
    public function createDiscountCustomMessagesMessenger(): DiscountCustomMessagesMessengerInterface
    {
        return new DiscountCustomMessagesMessenger(
            $this->createDiscountCustomMessagesReader(),
            $this->getMessengerFacade(),
            $this->getConfig()
        );
    }

    /**
     * @return \FondOfSpryker\Zed\DiscountCustomMessages\Dependency\Facade\DiscountCustomMessageToLocaleFacadeInterface
     */
    public function getLocaleFacade(): DiscountCustomMessageToLocaleFacadeInterface
    {
        return $this->getProvidedDependency(DiscountCustomMessagesDependencyProvider::FACADE_LOCALE);
    }

    /**
     * @return \FondOfSpryker\Zed\DiscountCustomMessages\Dependency\Facade\DiscountCustomMessageToMessengerFacadeInterface
     */
    public function getMessengerFacade(): DiscountCustomMessageToMessengerFacadeInterface
    {
        return $this->getProvidedDependency(DiscountCustomMessagesDependencyProvider::FACADE_MESSENGER);
    }

    /**
     * @return \FondOfSpryker\Zed\DiscountCustomMessages\Business\Model\DiscountCustomMessagesReaderInterface
     */
    public function createDiscountCustomMessagesReader(): DiscountCustomMessagesReaderInterface
    {
        return new DiscountCustomMessagesReader(
            $this->getRepository(),
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

    /**
     * @return \FondOfSpryker\Zed\DiscountCustomMessages\Dependency\Query\DiscountCustomMessagesToLocaleQueryContainerInterface
     */
    public function getLocaleQueryContainer(): DiscountCustomMessagesToLocaleQueryContainerInterface
    {
        return $this->getProvidedDependency(DiscountCustomMessagesDependencyProvider::QUERY_LOCALE);
    }
}
