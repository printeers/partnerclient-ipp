<?php

// Import classes we need for creating an order.
require_once(__DIR__."/../src/Client.php");
require_once(__DIR__."/../src/DestinationAddress.php");

// First we setup the API client and provide it with a partnercode, apikey and environment.
$client = new \Invition\Partnerclient\Client("TESTCODE", "testkey", "test");

// We're going to order an item that has a custom print.
// Therefore, we need to upload the image through the Invition API.
// This returns an image reference. The image reference is a unique code in the Invition platform
// which is linked to your account. The image reference can only be used for orders on the same account (apikey).
// An image reference can be used for multiple orders.
$imageBytes = file_get_contents("samsung-image.jpg", true);
$imageReference = $client->uploadImage($imageBytes);
echo "We have uploaded an image and it has reference: ".$imageReference."\n";

// Create a new bulk order
$bulkOrder = $client->newOrder("bulk");
// We cannot and don't have to set a destination address or shipping method.

// Lets add a single order line to the order, and set a print image on that line. There is no limit on the number of order lines.
$itemSKU = "B60670000"; // "Personalized Samsung S7" in the testing environment.
$quantity = 1;
$line = $bulkOrder->addLine($itemSKU, $quantity);

// For this personalized item, we use the image reference that we got after uploading the image earlier.
$line->setImageReference($imageReference);

// Set a partner reference
$bulkPartnerReference = date("m-d_H-i-s");
$bulkPartnerReference .= "bulk";
$bulkOrder->setPartnerReference($bulkPartnerReference);

// At this point we actually send the order through the Invition API
$error = $bulkOrder->execute();
if($error != null) {
	echo "An error has occurred during the order execution: ";
	var_dump($error);
	exit;
}

// To get the latest order status, use the client's getOrder method.
$orderInfo = $client->getOrder($bulkOrder->getReference());
var_dump($orderInfo);

// Alternatively, use the getOrderByPartnerReference method to use the customer
// partnerReference that was provided during order creation.
$orderInfoByPartnerRef = $client->getOrderByPartnerReference($bulkPartnerReference);
var_dump($orderInfoByPartnerRef);
