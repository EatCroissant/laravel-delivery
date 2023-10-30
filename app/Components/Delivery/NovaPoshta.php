<?php

namespace App\Components\Delivery;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class NovaPoshta implements DeliveryConnector
{

    private string $address;

    public function __construct(){
        $this->address = config('sender_address', 'default address');
    }

    public static function getName()
    {
        return 'nova_poshta';
    }

    public function createDelivery($deliveryData)
    {

        $uri = "https://novaposhta.test/api/delivery";
        $response = Http::post($uri, $deliveryData + ['sender_address' => $this->address]);

        // todo: Store delivery data

        if($response->failed()){
            Log::critical('Delivery error on service ' . static::class . " error message: " . $response->body() . " with code " . $response->status());
            throw new \Exception('Delivery error ' . $response->body());
        }
        Log::debug('Delivery registered ' . static::class . " with response: " . $response->body() . " with code " . $response->status());

        return $response->json();
    }
}
