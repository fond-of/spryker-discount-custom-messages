<?php

namespace FondOfSpryker\Zed\DiscountCustomMessages\Persistence;

use Generated\Shared\Transfer\DiscountCustomMessageTransfer;
use Orm\Zed\DiscountDiscountMessage\Persistence\FobDiscountCustomMessage;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \FondOfSpryker\Zed\DiscountCustomMessages\Persistence\DiscountCustomMessagesPersistenceFactory getFactory()
 */
class DiscountCustomMessagesRepository extends AbstractRepository implements DiscountCustomMessagesRepositoryInterface
{
    /**
     * @param int $idDiscount
     *
     * @return DiscountCustomMessageTransfer[]
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
     * @return DiscountCustomMessageTransfer|null
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
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
     * @return DiscountCustomMessageTransfer|null
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function findDiscountCustomMessageByIdDiscountAndIdLocale(int $idDiscount, int $idLocale): ?DiscountCustomMessageTransfer
    {
        $discountCustomMessageEntity = $this->getFactory()
            ->getDiscountCustomMessagesQuery()
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
     * @return DiscountCustomMessageTransfer|null
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
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
