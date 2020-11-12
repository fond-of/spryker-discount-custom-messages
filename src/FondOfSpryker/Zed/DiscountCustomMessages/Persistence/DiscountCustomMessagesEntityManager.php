<?php

namespace FondOfSpryker\Zed\DiscountCustomMessages\Persistence;

use Generated\Shared\Transfer\DiscountCustomMessageTransfer;
use Orm\Zed\DiscountDiscountMessage\Persistence\FobDiscountCustomMessage;
use Spryker\Zed\Kernel\Persistence\AbstractEntityManager;

/**
 * @method \FondOfSpryker\Zed\DiscountCustomMessages\Persistence\DiscountCustomMessagesPersistenceFactory getFactory()
 */
class DiscountCustomMessagesEntityManager extends AbstractEntityManager implements DiscountCustomMessagesEntityManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\DiscountCustomMessageTransfer $discountCustomMessageTransfer
     *
     * @return void
     */
    public function create(DiscountCustomMessageTransfer $discountCustomMessageTransfer): void
    {
        $this->getFactory()
            ->createDiscountCustomMessageMapper()
            ->mapTransferToEntity($discountCustomMessageTransfer, new FobDiscountCustomMessage())
            ->save();
    }

    /**
     * @param \Generated\Shared\Transfer\DiscountCustomMessageTransfer $discountCustomMessageTransfer
     *
     * @return void
     */
    public function update(DiscountCustomMessageTransfer $discountCustomMessageTransfer): void
    {
        $discountCustomMessageEntity = $this->getFactory()
            ->getDiscountCustomMessagesQuery()
            ->clear()
            ->filterByIdDiscountCustomMessage($discountCustomMessageTransfer->getIdDiscountCustomMessage())
            ->filterByFkDiscount($discountCustomMessageTransfer->getIdDiscount())
            ->findOne();

        if ($discountCustomMessageEntity === null) {
            return;
        }

        $discountCustomMessageEntity = $this->getFactory()
            ->createDiscountCustomMessageMapper()
            ->mapTransferToEntity($discountCustomMessageTransfer, $discountCustomMessageEntity);

        $discountCustomMessageEntity->save();
    }
}
