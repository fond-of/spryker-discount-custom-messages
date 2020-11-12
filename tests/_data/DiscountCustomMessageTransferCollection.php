<?php

$discountCustomMessageTransfer = new \Generated\Shared\Transfer\DiscountCustomMessageTransfer();
$localeTransfer = new \Generated\Shared\Transfer\LocaleTransfer();

$localeTransfer->setIdLocale(1)
    ->setLocaleName('TEST_COM')
    ->setIsActive(true);

$discountCustomMessageTransfer->setIdLocale(1)
    ->setIdDiscount(1)
    ->setIdDiscountCustomMessage(1)
    ->setLocale($localeTransfer)
    ->setIdLocale(1)
    ->setSuccessMessage('success')
    ->setErrorMessage('error');

return [$discountCustomMessageTransfer];
