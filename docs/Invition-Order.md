Invition\Partnerclient\Order
===============






* Class name: Order
* Namespace: Invition\Partnerclient







Methods
-------


### addLine

    mixed Invition\Partnerclient\Order::addLine(\Invition\Partnerclient\string $itemSKU, \Invition\Partnerclient\int $quantity)





* Visibility: **public**


#### Arguments
* $itemSKU **Invition\Partnerclient\string**
* $quantity **Invition\Partnerclient\int**



### removeLine

    mixed Invition\Partnerclient\Order::removeLine(\Invition\Partnerclient\OrderLine $line)

removeLine removes given orderline from the current order.

When an orderline is not related to the order (anymore), this throws an $Invition\PartnerclientExceptionLineDoesNotBelongToThisOrder;

* Visibility: **public**


#### Arguments
* $line **[Invition\Partnerclient\OrderLine](Invition\Partnerclient-OrderLine.md)**



### orderLines

    mixed Invition\Partnerclient\Order::orderLines()

orderLines returns an array of OrderLine objects.

Modifications to the array are not saved, to change the order lines, use
AddLine and RemoveLine.

* Visibility: **public**




### setDestinationAddress

    mixed Invition\Partnerclient\Order::setDestinationAddress(\Invition\Partnerclient\DestinationAddress $destinationAddress)





* Visibility: **public**


#### Arguments
* $destinationAddress **[Invition\Partnerclient\DestinationAddress](Invition\Partnerclient-DestinationAddress.md)**



### setShippingMethod

    mixed Invition\Partnerclient\Order::setShippingMethod(\Invition\Partnerclient\int $shippingMethodID)





* Visibility: **public**


#### Arguments
* $shippingMethodID **Invition\Partnerclient\int**



### setPartnerReference

    mixed Invition\Partnerclient\Order::setPartnerReference(\Invition\Partnerclient\string $partnerReference)





* Visibility: **public**


#### Arguments
* $partnerReference **Invition\Partnerclient\string**



### execute

    mixed Invition\Partnerclient\Order::execute()

execute sends the order to Invition\Partnerclient.

When an error occurs, the error object is returned.

* Visibility: **public**




### getReference

    mixed Invition\Partnerclient\Order::getReference()

getOrderReference returns the order reference of an order that has been executed.



* Visibility: **public**



