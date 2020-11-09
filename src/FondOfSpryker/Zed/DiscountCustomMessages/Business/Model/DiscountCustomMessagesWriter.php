<?php

namespace FondOfSpryker\Zed\DiscountCustomMessages\Business\Model;

use FondOfSpryker\Zed\DiscountCustomMessages\Business\Model\Mapper\DiscountCustomMessagesMapperInterface;
use FondOfSpryker\Zed\DiscountCustomMessages\Dependency\Facade\DiscountCustomMessageToLocaleFacadeInterface;
use FondOfSpryker\Zed\DiscountCustomMessages\Persistence\DiscountCustomMessagesEntityManagerInterface;
use FondOfSpryker\Zed\DiscountCustomMessages\Persistence\DiscountCustomMessagesRepositoryInterface;
use Generated\Shared\Transfer\DiscountConfiguratorTransfer;

class DiscountCustomMessagesWriter implements DiscountCustomMessagesWriterInterface
{
    /**
     * @var \FondOfSpryker\Zed\DiscountCustomMessages\Dependency\Facade\DiscountCustomMessageToLocaleFacadeInterface
     */
    protected $localeFacade;

    /**
     * @var \FondOfSpryker\Zed\DiscountCustomMessages\Persistence\DiscountCustomMessagesEntityManagerInterface
     */
    protected $customMessageEntityManager;

    /**
     * @param DiscountCustomMessagesEntityManagerInterface $customMessageEntityManager
     * @param DiscountCustomMessageToLocaleFacadeInterface $localeFacade
     */
    public function __construct(
        DiscountCustomMessagesEntityManagerInterface $customMessageEntityManager,
        DiscountCustomMessageToLocaleFacadeInterface $localeFacade
    ) {
        $this->localeFacade = $localeFacade;
        $this->customMessageEntityManager = $customMessageEntityManager;
    }

    /**
     * @param \Generated\Shared\Transfer\DiscountConfiguratorTransfer $discountConfiguratorTransfer
     *
     * @return \Generated\Shared\Transfer\DiscountConfiguratorTransfer
     */
    public function createByDiscountConfiguratorTransfer(DiscountConfiguratorTransfer $discountConfiguratorTransfer): DiscountConfiguratorTransfer
    {
        foreach ($discountConfiguratorTransfer->getDiscountCustomMessages() as $discountCustomMessageTransfer) {
            $discountCustomMessageTransfer->setIdDiscount($discountConfiguratorTransfer->getDiscountGeneral()->getIdDiscount());

            $this->customMessageEntityManager->create($discountCustomMessageTransfer);
        }

        return $discountConfiguratorTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\DiscountConfiguratorTransfer $discountConfiguratorTransfer
     *
     * @return \Generated\Shared\Transfer\DiscountConfiguratorTransfer
     */
    public function update(
        DiscountConfiguratorTransfer $discountConfiguratorTransfer
    ): DiscountConfiguratorTransfer {
        foreach ($discountConfiguratorTransfer->getDiscountCustomMessages() as $discountCustomMessageTransfer) {
            if (!$discountCustomMessageTransfer->getIdDiscountCustomMessage()) {
                $discountCustomMessageTransfer->setIdDiscount(
                    $discountConfiguratorTransfer->getDiscountGeneral()->getIdDiscount()
                );

                $this->customMessageEntityManager
                    ->create($discountCustomMessageTransfer);

                continue;
            }

            $this->customMessageEntityManager
                ->update($discountCustomMessageTransfer);
        }

        return $discountConfiguratorTransfer;
    }
}
