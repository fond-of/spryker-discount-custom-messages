<?php

namespace FondOfSpryker\Zed\DiscountCustomMessages\Business\Model;

use FondOfSpryker\Zed\DiscountCustomMessages\Dependency\Facade\DiscountCustomMessageToLocaleFacadeInterface;
use Generated\Shared\Transfer\DiscountConfiguratorTransfer;
use Generated\Shared\Transfer\DiscountCustomMessageTransfer;

class DiscountCustomMessagesExpander implements DiscountCustomMessagesExpanderInterface
{
    /**
     * @var \FondOfSpryker\Zed\DiscountCustomMessages\Dependency\Facade\DiscountCustomMessageToLocaleFacadeInterface
     */
    protected $localeFacade;

    public function __construct(DiscountCustomMessageToLocaleFacadeInterface $localeFacade)
    {
        $this->localeFacade = $localeFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\DiscountConfiguratorTransfer $discountConfiguratorTransfer
     *
     * @return \Generated\Shared\Transfer\DiscountConfiguratorTransfer
     */
    public function expandDefaultDiscountConfigurator(DiscountConfiguratorTransfer $discountConfiguratorTransfer): DiscountConfiguratorTransfer
    {
        foreach ($this->localeFacade->getLocaleCollection() as $localeTransfer) {
            $discountCustomMessageTransfer = (new DiscountCustomMessageTransfer())
                ->setLocale($localeTransfer);

            $discountConfiguratorTransfer->addDiscountCustomMessages($discountCustomMessageTransfer);
        }

        return $discountConfiguratorTransfer;
    }
}
