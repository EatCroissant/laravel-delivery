<?php

namespace App\Components\Delivery;

interface DeliveryConnector
{
    public static function getName();

    public function createDelivery(array $deliveryData);
}
