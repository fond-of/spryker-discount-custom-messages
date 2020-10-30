<?php

namespace FondOfSpryker\Zed\DiscountCustomMessages\Business\Model\Mapper;

use FondOfSpryker\Zed\DiscountCustomMessages\Dependency\Facade\DiscountCustomMessageToLocaleFacadeInterface;
use Generated\Shared\Transfer\DiscountCustomMessageTransfer;

class DiscountCustomMessagesMapper implements DiscountCustomMessagesMapperInterface
{
    /**
     * @var \FondOfSpryker\Zed\DiscountCustomMessages\Dependency\Facade\DiscountCustomMessageToLocaleFacadeInterface
     */
    protected $localeFacade;

    /**
     * @param \FondOfSpryker\Zed\DiscountCustomMessages\Dependency\Facade\DiscountCustomMessageToLocaleFacadeInterface $localeFacade
     */
    public function __construct(DiscountCustomMessageToLocaleFacadeInterface $localeFacade)
    {
        $this->localeFacade = $localeFacade;
    }

    /**
     * @param \Orm\Zed\DiscountDiscountMessage\Persistence\FobDiscountCustomMessage[]
     *
     * @return \Generated\Shared\Transfer\DiscountCustomMessageTransfer[]
     */
    public function mapTransfer(array $discountCustomMessageEntities): array
    {
        $collection = [];

        foreach ($discountCustomMessageEntities as $discountCustomMessagesEntity) {
            $localeTransfer = $this->localeFacade->getLocaleById($discountCustomMessagesEntity->getFkLocale());

            $discountCustomMessageTransfer = $this->createDiscountCustomMessageTransfer();
            $discountCustomMessageTransfer->fromArray($discountCustomMessagesEntity->toArray(), true);
            $discountCustomMessageTransfer->setIdDiscountCustomMessage($discountCustomMessagesEntity->getIdDiscountCustomMessage());
            $discountCustomMessageTransfer->setIdLocale($discountCustomMessagesEntity->getFkLocale());
            $discountCustomMessageTransfer->setIdDiscount($discountCustomMessagesEntity->getFkDiscount());
            $discountCustomMessageTransfer->setLocale($localeTransfer);

            $collection[] = $discountCustomMessageTransfer;
        }

        return $collection;
    }

    /**
     * @return \Generated\Shared\Transfer\DiscountCustomMessageTransfer
     */
    protected function createDiscountCustomMessageTransfer(): DiscountCustomMessageTransfer
    {
        return new DiscountCustomMessageTransfer();
    }
}
