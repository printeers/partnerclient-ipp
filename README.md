## Table of contents

- [\Invition\Partnerclient\StockList](#class-invitionstocklist)
- [\Invition\Partnerclient\Exception](#class-invitionexception)
- [\Invition\Partnerclient\Client](#class-invitionclient)
- [\Invition\Partnerclient\DestinationAddress](#class-invitiondestinationaddress)
- [\Invition\Partnerclient\ShippingMethods](#class-invitionshippingmethods)
- [\Invition\Partnerclient\Client](#class-invitionclient)
- [\Invition\Partnerclient\ShippingMethods](#class-invitionshippingmethods)
- [\Invition\Partnerclient\Exception](#class-invitionexception)
- [\Invition\Partnerclient\StockList](#class-invitionstocklist)
- [\Invition\Partnerclient\DestinationAddress](#class-invitiondestinationaddress)

<hr />

### Class: \Invition\Partnerclient\StockList

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>mixed</em> <strong>$data</strong>)</strong> : <em>void</em> |

<hr />

### Class: \Invition\Partnerclient\Exception

| Visibility | Function |
|:-----------|:---------|

*This class extends \Exception*

*This class implements \Throwable*

<hr />

### Class: \Invition\Partnerclient\Client

> Client implements the Invition Partner API, it provides methods to create an order, upload images and get existing order info.

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>\string</em> <strong>$partnercode</strong>, <em>\string</em> <strong>$apikey</strong>, <em>\string</em> <strong>$environment=`'test'`</strong>)</strong> : <em>void</em> |
| public | <strong>_checkAPIResultForErrors(</strong><em>mixed</em> <strong>$apiResult</strong>)</strong> : <em>void</em> |
| public | <strong>_doGet(</strong><em>mixed</em> <strong>$path</strong>)</strong> : <em>void</em> |
| public | <strong>_doPost(</strong><em>mixed</em> <strong>$path</strong>, <em>mixed</em> <strong>$data</strong>)</strong> : <em>void</em> |
| public | <strong>_doRequest(</strong><em>mixed</em> <strong>$curlRequest</strong>, <em>array</em> <strong>$headers=array()</strong>)</strong> : <em>void</em> |
| public | <strong>getOrder(</strong><em>mixed</em> <strong>$reference</strong>)</strong> : <em>mixed</em> |
| public | <strong>getOrderByPartnerReference(</strong><em>mixed</em> <strong>$reference</strong>)</strong> : <em>mixed</em> |
| public | <strong>getShippingMethods()</strong> : <em>mixed</em> |
| public | <strong>getStockList()</strong> : <em>mixed</em> |
| public | <strong>newOrder(</strong><em>string</em> <strong>$shippingKind=`'dropship'`</strong>)</strong> : <em>void</em> |
| public | <strong>uploadImage(</strong><em>mixed</em> <strong>$imageData</strong>)</strong> : <em>void</em> |

<hr />

### Class: \Invition\Partnerclient\DestinationAddress

> DestinationAddress contains the address details for an order.

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>mixed</em> <strong>$data=null</strong>)</strong> : <em>void</em> |
| public | <strong>jsonSerialize()</strong> : <em>void</em> |

*This class implements \JsonSerializable*

<hr />

### Class: \Invition\Partnerclient\ShippingMethods

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>mixed</em> <strong>$data</strong>)</strong> : <em>void</em> |

<hr />

### Class: \Invition\Partnerclient\Client

> Client implements the Invition Partner API, it provides methods to create an order, upload images and get existing order info.

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>\string</em> <strong>$partnercode</strong>, <em>\string</em> <strong>$apikey</strong>, <em>\string</em> <strong>$environment=`'test'`</strong>)</strong> : <em>void</em> |
| public | <strong>_checkAPIResultForErrors(</strong><em>mixed</em> <strong>$apiResult</strong>)</strong> : <em>void</em> |
| public | <strong>_doGet(</strong><em>mixed</em> <strong>$path</strong>)</strong> : <em>void</em> |
| public | <strong>_doPost(</strong><em>mixed</em> <strong>$path</strong>, <em>mixed</em> <strong>$data</strong>)</strong> : <em>void</em> |
| public | <strong>_doRequest(</strong><em>mixed</em> <strong>$curlRequest</strong>, <em>array</em> <strong>$headers=array()</strong>)</strong> : <em>void</em> |
| public | <strong>getOrder(</strong><em>mixed</em> <strong>$reference</strong>)</strong> : <em>mixed</em> |
| public | <strong>getOrderByPartnerReference(</strong><em>mixed</em> <strong>$reference</strong>)</strong> : <em>mixed</em> |
| public | <strong>getShippingMethods()</strong> : <em>mixed</em> |
| public | <strong>getStockList()</strong> : <em>mixed</em> |
| public | <strong>newOrder(</strong><em>string</em> <strong>$shippingKind=`'dropship'`</strong>)</strong> : <em>void</em> |
| public | <strong>uploadImage(</strong><em>mixed</em> <strong>$imageData</strong>)</strong> : <em>void</em> |

<hr />

### Class: \Invition\Partnerclient\ShippingMethods

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>mixed</em> <strong>$data</strong>)</strong> : <em>void</em> |

<hr />

### Class: \Invition\Partnerclient\Exception

| Visibility | Function |
|:-----------|:---------|

*This class extends \Exception*

*This class implements \Throwable*

<hr />

### Class: \Invition\Partnerclient\StockList

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>mixed</em> <strong>$data</strong>)</strong> : <em>void</em> |

<hr />

### Class: \Invition\Partnerclient\DestinationAddress

> DestinationAddress contains the address details for an order.

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>mixed</em> <strong>$data=null</strong>)</strong> : <em>void</em> |
| public | <strong>jsonSerialize()</strong> : <em>void</em> |

*This class implements \JsonSerializable*

