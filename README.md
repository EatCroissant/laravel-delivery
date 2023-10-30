## Delivery service

### Structure:

app\Components:
- Service connector file. For new services add new file implementing DeliveryConnector
- getName: static method reutrns name of service that can be used for selecting another services
- createDelivery:  try to create package in service with delivery data. Throw exception on failed connection or errors in request.

app\Http\Controllers:
- sendPackageData: method that sends data to service. For extending can be added param with "Service name" and passed as param to deliveryService->packageDelivery(request, Serivce_name)
- on success returns response and message
- on error show default laravel error page

app\Providers\DeliveryService
- register: boot registered service providers
- getAvailableServices: can be used to select delivery service on fronted (not route method created yet)
- packageDelivery: method creates service for delivery register and call process method from selected provider

routes:
- register routes

config\services.php:
- sets address to use from config method
