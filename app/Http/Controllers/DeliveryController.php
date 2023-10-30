<?php

namespace App\Http\Controllers;

use App\Components\Delivery\NovaPoshta;
use App\Http\Requests\PackageRequest;
use App\Http\Resources\PackageResponse;
use App\Providers\DeliveryService;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{

    /**
     * @var DeliveryService
     */
    private DeliveryService $deliveryService;

    public function __construct()
    {
        /** @var DeliveryService deliveryService  calls the boot method of class*/
        $this->deliveryService = app(DeliveryService::class);
    }


    public function sendPackageData(PackageRequest $request)
    {
        $requestArray = $request->only([
            'dimensions', // Sizes of package
            'customer_name', // ФИО
            'phone_number', // phone 066(7...) | 38066(7...)
            'email', // valid email
            'delivery_address' // deliver to
        ]);

        $requestArray['phone_number'] = "+${requestArray['phone_number']}";

        /*
            Json array from response
            Calls delivery service and send response
            When new services added, need to fetch valid name
            Then register service into deliveryService class method
        */
        $response = $this->deliveryService->packageDelivery($requestArray, NovaPoshta::getName());

        return $this->json(['response' => $response, 'message' => 'delivery register success', 'success' => true]);
    }


    public function json($data = [], $status = 200)
    {
        return response()->json($data, $status);
    }
}
