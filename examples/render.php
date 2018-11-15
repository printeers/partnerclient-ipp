<?php

// Import classes we need for creating an order.
require_once(__DIR__."/../src/Client.php");
require_once(__DIR__."/../src/DestinationAddress.php");

// First we setup the API client and provide it with a partnercode, apikey and environment.
$client = new \Invition\Partnerclient\Client("TESTCODE", "testkey", "test");

// read image bytes
$imageBytes = file_get_contents("samsung-image.jpg", true);

$sku = "B60670000"; // Personalized Samsung S7

// Obtain the stocklist
$stocklist = $client->getStockList();

// call render API using sku and image bytes
$mockupBytes = $client->render($sku, $imageBytes);

// put result into file
file_put_contents("mockup-".$sku.".jpg", $mockupBytes);