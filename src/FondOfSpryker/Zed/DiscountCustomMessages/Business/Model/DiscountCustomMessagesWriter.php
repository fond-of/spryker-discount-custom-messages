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
    ): DiscountConfiguratorTransfer {$locales = $this->localeFacade->getLocaleCollection();
        foreach ($discountConfiguratorTransfer->getDiscountCustomMessages() as $discountCustomMessageTransfer) {
            if (!$discountCustomMessageTransfer->getIdDiscountCustomMessage()) {
                $discountCustomMessageEntity = $this->hydrateDiscountCustomMessageEntity(
                    $this->createDiscountCustomMessageEntity(),
                    $discountCustomMessageTransfer,
                    $discountConfiguratorTransfer->getDiscountGeneral()->getIdDiscount()
                );

                $discountCustomMessageEntity->save();

                continue;
            }

            $discountCustomMessageEntity = $this->customMessagesQueryContainer
                ->queryDiscountCustomMessageByIdAndIdDiscount(
                    $discountCustomMessageTransfer->getIdDiscountCustomMessage(),
                    $discountCustomMessageTransfer->getIdDiscount()
                );

            if ($discountCustomMessageEntity === null) {
                continue;
            }

            $discountCustomMessageEntity->fromArray($discountCustomMessageTransfer->toArray());
            $discountCustomMessageEntity->save();
        }

        return $discountConfiguratorTransfer;
    }

    /**
     * @return \Orm\Zed\DiscountDiscountMessage\Persistence\FobDiscountCustomMessage
     */
    protected function createDiscountCustomMessageEntity(): FobDiscountCustomMessage
    {
        return new FobDiscountCustomMessage();
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
