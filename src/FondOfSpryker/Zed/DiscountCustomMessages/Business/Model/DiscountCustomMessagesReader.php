<?php

namespace FondOfSpryker\Zed\DiscountCustomMessages\Business\Model;

use FondOfSpryker\Zed\DiscountCustomMessages\Business\Model\Mapper\DiscountCustomMessagesMapperInterface;
use FondOfSpryker\Zed\DiscountCustomMessages\Dependency\Facade\DiscountCustomMessageToLocaleFacadeInterface;
use FondOfSpryker\Zed\DiscountCustomMessages\Persistence\DiscountCustomMessagesRepositoryInterface;
use Generated\Shared\Transfer\DiscountConfiguratorTransfer;
use Generated\Shared\Transfer\DiscountCustomMessageTransfer;
use Generated\Shared\Transfer\DiscountTransfer;

class DiscountCustomMessagesReader implements DiscountCustomMessagesReaderInterface
{
    /**
     * @var \FondOfSpryker\Zed\DiscountCustomMessages\Business\Model\Mapper\DiscountCustomMessagesMapperInterface
     */
    protected $discountCustomMessagesMapper;

    /**
     * @var \FondOfSpryker\Zed\DiscountCustomMessages\Dependency\Facade\DiscountCustomMessageToLocaleFacadeInterface
     */
    protected $localeFacade;

    /**
     * @var \FondOfSpryker\Zed\DiscountCustomMessages\Persistence\DiscountCustomMessagesRepositoryInterface
     */
    protected $discountCustomMessagesRepository;

    /**
     * @param \FondOfSpryker\Zed\DiscountCustomMessages\Persistence\DiscountCustomMessagesRepositoryInterface $discountCustomMessagesRepository
     * @param \FondOfSpryker\Zed\DiscountCustomMessages\Business\Model\Mapper\DiscountCustomMessagesMapperInterface $discountCustomMessagesMapper
     * @param \FondOfSpryker\Zed\DiscountCustomMessages\Dependency\Facade\DiscountCustomMessageToLocaleFacadeInterface $localeFacade
     */
    public function __construct(
        DiscountCustomMessagesRepositoryInterface $discountCustomMessagesRepository,
        DiscountCustomMessagesMapperInterface $discountCustomMessagesMapper,
        DiscountCustomMessageToLocaleFacadeInterface $localeFacade
    ) {
        $this->discountCustomMessagesMapper = $discountCustomMessagesMapper;
        $this->localeFacade = $localeFacade;
        $this->discountCustomMessagesRepository = $discountCustomMessagesRepository;
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
        $discountCustomMessagesEntities = $this->discountCustomMessagesRepository
            ->findDiscountCustomMessagesByIdDiscount($idDiscount);

        if (!$discountCustomMessagesEntities) {
            return $this->createEmptyMessages();
        }

        return $discountCustomMessagesEntities;
    }

    /**
     * @param \Generated\Shared\Transfer\DiscountTransfer $discountTransfer
     *
     * @return \Generated\Shared\Transfer\DiscountCustomMessageTransfer|null
     */
    public function findCustomMessageByIdDiscountAndCurrentLocale(DiscountTransfer $discountTransfer): ?DiscountCustomMessageTransfer
    {
        if (!$discountTransfer->getIdDiscount()) {
            return null;
        }

        $discountCustomMessagesTransfer = $this->discountCustomMessagesRepository
            ->findDiscountCustomMessageByIdDiscountAndIdLocale(
                $discountTransfer->getIdDiscount(),
                $this->localeFacade->getCurrentLocale()->getIdLocale()
            );

        if ($discountCustomMessagesTransfer === null) {
            return null;
        }

        return $discountCustomMessagesTransfer;
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

            $collection[] = $discountCustomMessageTransfer;
        }

        return $collection;
    }
}
