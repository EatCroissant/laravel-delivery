<?php

namespace App\Providers;

use App\Components\Delivery\DeliveryConnector;
use App\Components\Delivery\NovaPoshta;
use Illuminate\Support\ServiceProvider;

class DeliveryService extends ServiceProvider
{
    private $services = [];

    /**
     * Register services.
     */
    public function register(): void
    {
        $services = [
            NovaPoshta::class
        ];

        foreach ($services as $service) {
            $registry = new $service();
            if ($registry instanceof DeliveryConnector) {
                $this->services[$registry::getName()] = $registry;
            }
        }
    }

    public function getAvailableServices(): array
    {
        if(empty($this->services)) $this->register();
        return array_keys($this->services);
    }

    /**
     * Delivery request to selected provider. default is NP
     * @throws \Exception
     */

    public function packageDelivery($deliveryPackageDate, $deliveryService)
    {
        if (isset($this->services[$deliveryService])) {
            $srv = new $this->services[$deliveryService]();
            return $srv->createDelivery($deliveryPackageDate);
        }
        throw new \Exception("Delivery Service not found");
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
