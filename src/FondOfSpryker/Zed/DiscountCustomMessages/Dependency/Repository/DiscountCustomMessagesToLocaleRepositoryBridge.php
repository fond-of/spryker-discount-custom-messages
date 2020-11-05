<?php

namespace FondOfSpryker\Zed\DiscountCustomMessages\Dependency\Repository;

use Generated\Shared\Transfer\LocaleTransfer;
use Spryker\Zed\Locale\Persistence\LocaleRepositoryInterface;

class DiscountCustomMessagesToLocaleRepositoryBridge implements DiscountCustomMessagesToLocaleRepositoryInterface
{
    /**
     * @var \Spryker\Zed\Locale\Persistence\LocaleRepositoryInterface
     */
    protected $localeRepository;

    public function __construct(LocaleRepositoryInterface $localeRepository)
    {
        $this->localeRepository = $localeRepository;
    }

    /**
     * @param string $localeName
     *
     * @return \Generated\Shared\Transfer\LocaleTransfer|null
     */
    public function findLocaleTransferByLocaleName(string $localeName): ?LocaleTransfer
    {
        return $this->localeRepository->findLocaleTransferByLocaleName($localeName);
    }
}
