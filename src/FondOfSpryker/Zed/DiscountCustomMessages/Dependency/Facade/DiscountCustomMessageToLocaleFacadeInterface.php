<?php

namespace FondOfSpryker\Zed\DiscountCustomMessages\Dependency\Facade;

interface DiscountCustomMessageToLocaleFacadeInterface
{
    /**
     * @return \Generated\Shared\Transfer\LocaleTransfer[]
     */
    public function getLocaleCollection(): array;
}
