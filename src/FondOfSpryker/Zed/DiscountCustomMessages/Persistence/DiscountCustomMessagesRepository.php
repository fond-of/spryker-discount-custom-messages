<?php

namespace FondOfSpryker\Zed\DiscountCustomMessages\Persistence;

use Generated\Shared\Transfer\DiscountCustomMessageTransfer;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \FondOfSpryker\Zed\DiscountCustomMessages\Persistence\DiscountCustomMessagesPersistenceFactory getFactory()
 */
class DiscountCustomMessagesRepository extends AbstractRepository implements DiscountCustomMessagesRepositoryInterface
{
    /**
     * @param int $idDiscount
     *
     * @return \Generated\Shared\Transfer\DiscountCustomMessageTransfer[]
     */
    public function findDiscountCustomMessagesByIdDiscount(int $idDiscount): array
    {
        $discountCustomMessageEntities = $this->getFactory()
            ->getDiscountCustomMessagesQuery()
            ->findByFkDiscount($idDiscount);

        if (!$discountCustomMessageEntities) {
            return [];
        }

        $collection = [];

        foreach ($discountCustomMessageEntities as $discountCustomMessageEntity) {
            $collection[] = $this->getFactory()
                ->createDiscountCustomMessageMapper()
                ->mapEntityToTransfer($discountCustomMessageEntity, new DiscountCustomMessageTransfer());
        }

        return $collection;
    }

    /**
     * @param int $idDiscountCustomMessage
     * @param int $idDiscount
     *
     * @return \Generated\Shared\Transfer\DiscountCustomMessageTransfer|null
     */
    public function findDiscountCustomMessageByIdAndIdDiscount(int $idDiscountCustomMessage, int $idDiscount): ?DiscountCustomMessageTransfer
    {
        $discountCustomMessageEntity = $this->getFactory()
            ->getDiscountCustomMessagesQuery()
            ->filterByIdDiscountCustomMessage($idDiscountCustomMessage)
            ->filterByFkDiscount($idDiscount)
            ->findOne();

        if ($discountCustomMessageEntity === null) {
            return null;
        }

        return $this->getFactory()
            ->createDiscountCustomMessageMapper()
            ->mapEntityToTransfer($discountCustomMessageEntity, new DiscountCustomMessageTransfer());
    }

    /**
     * @param int $idDiscount
     * @param int $idLocale
     *
     * @return \Generated\Shared\Transfer\DiscountCustomMessageTransfer|null
     */
    public function findDiscountCustomMessageByIdDiscountAndIdLocale(int $idDiscount, int $idLocale): ?DiscountCustomMessageTransfer
    {
        $discountCustomMessageEntity = $this->getFactory()
            ->getDiscountCustomMessagesQuery()
            ->clear()
            ->filterByFkDiscount($idDiscount)
            ->filterByFkLocale($idLocale)
            ->findOne();

        if ($discountCustomMessageEntity === null) {
            return null;
        }

        return $this->getFactory()
            ->createDiscountCustomMessageMapper()
            ->mapEntityToTransfer($discountCustomMessageEntity, new DiscountCustomMessageTransfer());
    }

    /**
     * @param int $idDiscountCustomMessage
     *
     * @return \Generated\Shared\Transfer\DiscountCustomMessageTransfer|null
     */
    public function findDiscountCustomMessageById(int $idDiscountCustomMessage): ?DiscountCustomMessageTransfer
    {
        $discountCustomMessageEntity = $this->getFactory()
            ->getDiscountCustomMessagesQuery()
            ->filterByIdDiscountCustomMessage($idDiscountCustomMessage)
            ->findOne();

        if ($discountCustomMessageEntity === null) {
            return null;
        }

        return $this->getFactory()
            ->createDiscountCustomMessageMapper()
            ->mapEntityToTransfer($discountCustomMessageEntity, new DiscountCustomMessageTransfer());
    }
}
