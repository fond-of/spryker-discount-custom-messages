<?php

namespace FondOfSpryker\Zed\DiscountCustomMessages\Dependency\Facade;

use Generated\Shared\Transfer\LocaleTransfer;
use Spryker\Zed\Locale\Business\LocaleFacadeInterface;

class DiscountCustomMessageToLocaleFacadeBridge implements DiscountCustomMessageToLocaleFacadeInterface
{
    /**
     * @var \Spryker\Zed\Locale\Business\LocaleFacadeInterface
     */
    private $localeFacade;

    public function __construct(LocaleFacadeInterface $localeFacade)
    {
        $this->localeFacade = $localeFacade;
    }

    /**
     * @return \Generated\Shared\Transfer\LocaleTransfer[]
     */
    public function getLocaleCollection(): array
    {
        return $this->localeFacade->getLocaleCollection();
    }

    /**
     * @param int $idLocale
     *
     * @return \Generated\Shared\Transfer\LocaleTransfer
     */
    public function getLocaleById(int $idLocale): LocaleTransfer
    {
        return $this->localeFacade
            ->getLocaleById($idLocale);
    }
}
