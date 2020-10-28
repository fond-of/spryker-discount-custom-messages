<?php

namespace FondOfSpryker\Zed\DiscountCustomMessages\Business\Model;

use FondOfSpryker\Zed\DiscountCustomMessages\Business\Model\Mapper\DiscountCustomMessagesMapperInterface;
use FondOfSpryker\Zed\DiscountCustomMessages\Dependency\Facade\DiscountCustomMessageToLocaleFacadeInterface;
use FondOfSpryker\Zed\DiscountCustomMessages\Persistence\DiscountCustomMessagesQueryContainerInterface;
use Generated\Shared\Transfer\DiscountConfiguratorTransfer;
use Generated\Shared\Transfer\DiscountCustomMessageTransfer;

class DiscountCustomMessagesReader implements DiscountCustomMessagesReaderInterface
{
    /**
     * @var \FondOfSpryker\Zed\DiscountCustomMessages\Persistence\DiscountCustomMessagesQueryContainerInterface
     */
    protected $customMessagesQueryContainer;

    /**
     * @var \FondOfSpryker\Zed\DiscountCustomMessages\Business\Model\Mapper\DiscountCustomMessagesMapperInterface
     */
    protected $discountCustomMessagesMapper;

    /**
     * @var \FondOfSpryker\Zed\DiscountCustomMessages\Dependency\Facade\DiscountCustomMessageToLocaleFacadeInterface
     */
    protected $localeFacade;

    /**
     * @param \FondOfSpryker\Zed\DiscountCustomMessages\Persistence\DiscountCustomMessagesQueryContainerInterface $customMessagesQueryContainer
     * @param \FondOfSpryker\Zed\DiscountCustomMessages\Business\Model\Mapper\DiscountCustomMessagesMapperInterface $discountCustomMessagesMapper
     * @param \FondOfSpryker\Zed\DiscountCustomMessages\Dependency\Facade\DiscountCustomMessageToLocaleFacadeInterface $localeFacade
     */
    public function __construct(
        DiscountCustomMessagesQueryContainerInterface $customMessagesQueryContainer,
        DiscountCustomMessagesMapperInterface $discountCustomMessagesMapper,
        DiscountCustomMessageToLocaleFacadeInterface $localeFacade
    ) {
        $this->customMessagesQueryContainer = $customMessagesQueryContainer;
        $this->discountCustomMessagesMapper = $discountCustomMessagesMapper;
        $this->localeFacade = $localeFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\DiscountConfiguratorTransfer $discountConfiguratorTransfer
     *
     * @return \Generated\Shared\Transfer\DiscountConfiguratorTransfer
     */
    public function expandDiscountCustomMessages(DiscountConfiguratorTransfer $discountConfiguratorTransfer)
    {
        $idDiscount = $discountConfiguratorTransfer->getDiscountGeneral()->getIdDiscount();
        $discountCustomMessageTransfers = $this->findDiscountCustomMessagesByIdDiscount($idDiscount);

        foreach ($discountCustomMessageTransfers as $discountCustomMessageTransfer) {
            $discountConfiguratorTransfer->addDiscountCustomMessages($discountCustomMessageTransfer);
        }

        return $discountConfiguratorTransfer;
    }

    /**
     * @param int $idDiscount
     *
     * @return \Generated\Shared\Transfer\DiscountCustomMessageTransfer[]
     */
    public function findDiscountCustomMessagesByIdDiscount(int $idDiscount): array
    {
        $discountCustomMessagesEntities = $this->customMessagesQueryContainer
            ->queryDiscountCustomMessagesByIdDiscount($idDiscount);

        if (!$discountCustomMessagesEntities) {
            return $this->createEmptyMessages();
        }

        return $this->discountCustomMessagesMapper->mapTransfer($discountCustomMessagesEntities->getData());
    }

    /**
     * @return \Generated\Shared\Transfer\DiscountCustomMessageTransfer
     */
    protected function createDiscountCustomMessageTransfer(): DiscountCustomMessageTransfer
    {
        return new DiscountCustomMessageTransfer();
    }

    /**
     * @return \Generated\Shared\Transfer\DiscountCustomMessageTransfer[]
     */
    protected function createEmptyMessages(): array
    {
        $collection = [];

        foreach ($this->localeFacade->getLocaleCollection() as $localeTransfer) {
            $discountCustomMessageTransfer = $this->createDiscountCustomMessageTransfer();
            $discountCustomMessageTransfer->setLocale($localeTransfer);
        }

        return $collection;
    }
}
