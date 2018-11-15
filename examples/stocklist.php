<?php

// Import the Client class without using composer
require_once(__DIR__."/../src/Client.php");

// Create a new Client with a partnercode, apikey and environment
$client = new \Invition\Partnerclient\Client("TESTCODE", "testkey", "test");

// Obtain the stocklist
$stocklist = $client->getStockList();

print_r($stocklist);
