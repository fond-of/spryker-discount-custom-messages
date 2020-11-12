<?php

use Orm\Zed\DiscountDiscountMessage\Persistence\FobDiscountCustomMessage;
use \Orm\Zed\Locale\Persistence\SpyLocale;



$customMessageEntity = new FobDiscountCustomMessage();
$customMessageEntity
    ->setIdDiscountCustomMessage(1)
    ->setFkDiscount(1)
    ->setSuccessMessage('success')
    ->setErrorMessage('error');

return $customMessageEntity;
