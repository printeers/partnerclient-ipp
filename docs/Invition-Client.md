Invition\Partnerclient\Client
===============

Client implements the Invition\Partnerclient Partner API, it provides methods to create an order, upload images and get existing order info.




* Class name: Client
* Namespace: Invition\Partnerclient



Constants
----------


### version

    const version = "0.1"







Methods
-------


### __construct

    mixed Invition\Partnerclient\Client::__construct(\Invition\Partnerclient\string $partnercode, \Invition\Partnerclient\string $apikey, \Invition\Partnerclient\string $environment)





* Visibility: **public**


#### Arguments
* $partnercode **Invition\Partnerclient\string**
* $apikey **Invition\Partnerclient\string**
* $environment **Invition\Partnerclient\string**



### newOrder

    mixed Invition\Partnerclient\Client::newOrder($shippingKind)





* Visibility: **public**


#### Arguments
* $shippingKind **mixed**



### getStockList

    mixed Invition\Partnerclient\Client::getStockList()





* Visibility: **public**




### getShippingMethods

    mixed Invition\Partnerclient\Client::getShippingMethods()





* Visibility: **public**




### uploadImage

    mixed Invition\Partnerclient\Client::uploadImage($imageData)





* Visibility: **public**


#### Arguments
* $imageData **mixed**



### getOrder

    mixed Invition\Partnerclient\Client::getOrder($reference)





* Visibility: **public**


#### Arguments
* $reference **mixed**



### getOrderByPartnerReference

    mixed Invition\Partnerclient\Client::getOrderByPartnerReference($reference)





* Visibility: **public**


#### Arguments
* $reference **mixed**


