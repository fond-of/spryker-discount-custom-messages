<?php

namespace FondOfSpryker\Zed\DiscountCustomMessages\Business\Model;

use FondOfSpryker\Zed\DiscountCustomMessages\Business\Model\Mapper\DiscountCustomMessagesMapperInterface;
use FondOfSpryker\Zed\DiscountCustomMessages\Dependency\Facade\DiscountCustomMessageToLocaleFacadeInterface;
use FondOfSpryker\Zed\DiscountCustomMessages\Persistence\DiscountCustomMessagesQueryContainerInterface;
use Generated\Shared\Transfer\DiscountConfiguratorTransfer;
use Generated\Shared\Transfer\DiscountCustomMessageTransfer;
use Orm\Zed\DiscountDiscountMessage\Persistence\FobDiscountCustomMessage;

class DiscountCustomMessagesWriter implements DiscountCustomMessagesWriterInterface
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
    public function updateDiscountCustomMessages(
        DiscountConfiguratorTransfer $discountConfiguratorTransfer
    ): DiscountConfiguratorTransfer {
        if ($discountConfiguratorTransfer->getDiscountCustomMessages()->count() === 0) {
            return $this->createDiscountMessagesByLocale($discountConfiguratorTransfer);
        }

        foreach ($discountConfiguratorTransfer->getDiscountCustomMessages() as $discountCustomMessageTransfer) {
            $idDiscountCustomMessage = $discountCustomMessageTransfer->getIdDiscountCustomMessage();

            if ($idDiscountCustomMessage === null) {
                $this->saveNewEntity($discountConfiguratorTransfer, $discountCustomMessageTransfer);

                continue;
            }

            $this->saveExistingEntity($discountConfiguratorTransfer, $discountCustomMessageTransfer);
        }

        return $discountConfiguratorTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\DiscountConfiguratorTransfer $discountConfiguratorTransfer
     * @param \Generated\Shared\Transfer\DiscountCustomMessageTransfer $discountCustomMessageTransfer
     *
     * @return void
     */
    protected function saveExistingEntity(
        DiscountConfiguratorTransfer $discountConfiguratorTransfer,
        DiscountCustomMessageTransfer $discountCustomMessageTransfer
    ): void {
        $idDiscount = $discountConfiguratorTransfer->getDiscountGeneral()->getIdDiscount();
        $idDiscountCustomMessage = $discountCustomMessageTransfer->getIdDiscountCustomMessage();

        $discountCustomMessageEntity = $this->customMessagesQueryContainer
            ->queryDiscountCustomMessageByIdAndIdDiscount($idDiscountCustomMessage, $idDiscount);

        if (!$discountCustomMessageEntity) {
            return;
        }

        $discountCustomMessageEntity = $this->hydrateDiscountCustomMessageEntity(
            $discountCustomMessageEntity,
            $discountCustomMessageTransfer,
            $idDiscount
        );

        $discountCustomMessageEntity->save();
    }

    /**
     * @param \Generated\Shared\Transfer\DiscountConfiguratorTransfer $discountConfiguratorTransfer
     * @param \Generated\Shared\Transfer\DiscountCustomMessageTransfer $discountCustomMessageTransfer
     *
     * @return void
     */
    protected function saveNewEntity(
        DiscountConfiguratorTransfer $discountConfiguratorTransfer,
        DiscountCustomMessageTransfer $discountCustomMessageTransfer
    ): void {
        $discountCustomMessageEntity = $this->hydrateDiscountCustomMessageEntity(
            new FobDiscountCustomMessage(),
            $discountCustomMessageTransfer,
            $discountConfiguratorTransfer->getDiscountGeneral()->getIdDiscount()
        );

        $discountCustomMessageEntity->save();
    }

    /**
     * @param \Generated\Shared\Transfer\DiscountConfiguratorTransfer $discountConfiguratorTransfer
     *
     * @return \Generated\Shared\Transfer\DiscountConfiguratorTransfer
     */
    protected function createDiscountMessagesByLocale(DiscountConfiguratorTransfer $discountConfiguratorTransfer)
    {
        $idDiscount = $discountConfiguratorTransfer->getDiscountGeneral()->setIdDiscount();

        foreach ($this->localeFacade->getLocaleCollection() as $localeTransfer) {
            $discountCustomMessageTransfer = new DiscountCustomMessageTransfer();
            $discountCustomMessageTransfer->setLocale($localeTransfer);
            $discountCustomMessageTransfer->setIdLocale($localeTransfer->getIdLocale());
            $discountCustomMessageTransfer->setIdDiscount($idDiscount);

            $discountConfiguratorTransfer->addDiscountCustomMessages($discountCustomMessageTransfer);
        }

        return $discountConfiguratorTransfer;
    }

    /**
     * @param \Orm\Zed\DiscountDiscountMessage\Persistence\FobDiscountCustomMessage $discountCustomMessageEntity
     * @param \Generated\Shared\Transfer\DiscountCustomMessageTransfer $discountCustomMessageTransfer
     * @param int $idDiscount
     *
     * @return \Orm\Zed\DiscountDiscountMessage\Persistence\FobDiscountCustomMessage
     */
    protected function hydrateDiscountCustomMessageEntity(
        FobDiscountCustomMessage $discountCustomMessageEntity,
        DiscountCustomMessageTransfer $discountCustomMessageTransfer,
        int $idDiscount
    ): FobDiscountCustomMessage {
        $discountCustomMessageEntity->fromArray($discountCustomMessageTransfer->toArray());
        $discountCustomMessageEntity->setFkDiscount($idDiscount);
        $discountCustomMessageEntity->setSuccessMessage($discountCustomMessageTransfer->getSuccessMessage());
        $discountCustomMessageEntity->setErrorMessage($discountCustomMessageTransfer->getErrorMessage());
        $discountCustomMessageEntity->setFkLocale($discountCustomMessageTransfer->getLocale()->getIdLocale());

        return $discountCustomMessageEntity;
    }
}
