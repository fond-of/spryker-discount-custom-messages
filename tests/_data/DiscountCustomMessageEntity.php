<?php

use Orm\Zed\DiscountDiscountMessage\Persistence\FooDiscountCustomMessage;

$customMessageEntity = new FooDiscountCustomMessage();
$customMessageEntity
    ->setIdDiscountCustomMessage(1)
    ->setFkDiscount(1)
    ->setSuccessMessage('success')
    ->setErrorMessage('error');

return $customMessageEntity;
