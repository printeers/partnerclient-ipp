<?php

// Import classes we need for creating an order.
require_once(__DIR__."/../src/Client.php");
require_once(__DIR__."/../src/DestinationAddress.php");

// First we setup the API client and provide it with a partnercode, apikey and environment.
$client = new \Invition\Partnerclient\Client("TESTCODE", "testkey", "test");

echo "going to do dropship order\n";

// Create a new order, by default it it of type dropship.
$dropshipOrder = $client->newOrder();
// You might give "dropship" explicit as first argument, like so:
// $dropshipOrder = $client->newOrder("dropship");

// Add a destination address
$dest = new \Invition\Partnerclient\DestinationAddress();
$dest->firstname = "Geert-Johan";
$dest->lastname = "Riemer";
$dest->streetname = "Compagniestraat";
$dest->housenumber = "75";
$dest->housenumberAddition = "A";
$dest->additionalInfo = "Ring twice";
$dest->zipcode = "1813SX";
$dest->city = "Alkmaar";
$dest->countryCode = "NL";
$dest->phonenumber = "+31612345678";
$dest->email = "geertjohan@invition.eu";
$dropshipOrder->setDestinationAddress($dest);

// We're going to order an item that has a custom print.
// Therefore, we need to upload the image through the Invition API.
// This returns an image reference. The image reference is a unique code in the Invition platform
// which is linked to your account. The image reference can only be used for orders on the same account (apikey).
// An image reference can be used for multiple orders.
$imageBytes = file_get_contents("samsung-image.jpg", true);
$imageReference = $client->uploadImage($imageBytes);
echo "We have uploaded an image and it has reference: ".$imageReference."\n";

// Lets add a single order line to the order, and set a print image on that line. There is no limit on the number of order lines.
$itemSKU = "B60670000"; // "Personalized Samsung S7" in the testing environment.
$quantity = 1;
$line = $dropshipOrder->addLine($itemSKU, $quantity);

// For this personalized item, we use the image reference that we got after uploading the image earlier.
$line->setImageReference($imageReference);

// Fetch shipping methods
$shippingMethods = $client->getShippingMethods();

// Select a shipping method by name
$shippingMethodB2CLiteLarge = reset(array_filter(
	$shippingMethods->methods,
	function($e) {
		return $e->name === "B2C-ParcelLiteLarge";
	}
));

// Set preferred shipping method on the order.
// This is optional. We will choose a shipping method when a prefered method is not set.
$dropshipOrder->setShippingMethod($shippingMethodB2CLiteLarge->id);

// Create and set a custom reference on the order.
// This value should be unique for each order.
// In this example the date is good enough,
// but for production systems make sure to use a unique ID.
$partnerReference = date("Y-m-d_H-i-s");
$dropshipOrder->setPartnerReference($partnerReference);

// At this point we actually send the order through the Invition API
$error = $dropshipOrder->execute();
if($error != null) {
	echo "An error has occurred during the order execution: ";
	var_dump($error);
	exit;
}

// If there was no error, all went fine and we now have a order reference.
// Do save this reference in your database, it is used to retreive order status
echo "We have created an order and its reference is: ".$dropshipOrder->getReference()."\n";

// To get the latest order status, use the client's getOrder method.
$orderInfo = $client->getOrder($dropshipOrder->getReference());
var_dump($orderInfo);

// Alternatively, use the getOrderByPartnerReference method to use the customer
// partnerReference that was provided during order creation.
$orderInfo2 = $client->getOrderByPartnerReference($partnerReference);
var_dump($orderInfo2);
