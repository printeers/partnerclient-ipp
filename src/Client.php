<?php

namespace Invition\Partnerclient;

require_once(__DIR__ . '/Order.php');
require_once(__DIR__ . '/ShippingMethods.php');
require_once(__DIR__ . '/StockList.php');
require_once(__DIR__ . '/OrderInfo.php');
require_once(__DIR__ . '/Exception.php');

/**
 * Client implements the Invition Partner API, it provides methods to create an order, upload images and get existing order info.
 */
class Client {
	const version = "0.1";

	private $partnercode;
	private $apikey;
	private $env;

	public function __construct(string $partnercode, string $apikey, string $environment = "test") {
		$this->partnercode = $partnercode;
		$this->apikey = $apikey;
		$this->env = $environment;
	}

	private function _apiURL(): string {
		switch($this->env) {
		case "prod":
		case "acc":
		case "test":
		case "dev":
			return "https://api.".$this->env.".invition.nl/";
			break;
		case "local":
			return "http://localhost:8002/";
			break;
		default:
			throw new Exception("invalid environment");
		}
	}

	/**
	 * @internal
	 */
	public function _doGet($path) {
		$curlRequest = curl_init($this->_apiURL().$path);
		return $this->_doRequest($curlRequest);
	}

	/**
	 * @internal
	 */
	public function _doPost($path, $data) {
		$curlRequest = curl_init($this->_apiURL().$path);
		curl_setopt($curlRequest, CURLOPT_CUSTOMREQUEST, "POST");
		$dataJSON = json_encode($data);
		curl_setopt($curlRequest, CURLOPT_POSTFIELDS, $dataJSON);
		return $this->_doRequest($curlRequest, array("Content-Type: application/json", "Content-Length: ".strlen($dataJSON)));
	}

	/**
	 * @internal
	 */
	public function _doRequest($curlRequest, $headers = []) {
		curl_setopt($curlRequest, CURLOPT_HTTPHEADER, array_merge(array("x-ipp-partnercode: ".$this->partnercode, "x-ipp-apikey: ".$this->apikey), $headers));
		curl_setopt($curlRequest, CURLOPT_USERAGENT, "php-partnerclient-".Client::version);
		curl_setopt($curlRequest, CURLOPT_RETURNTRANSFER, true);
		$data = curl_exec($curlRequest);
		$status = curl_getinfo($curlRequest,CURLINFO_HTTP_CODE);
		curl_close($curlRequest);
		if($status !== 200) {
			throw new Exception("API request returned http status ".$status." with data: ".$data);
		}
		$result = json_decode($data);
		$this->_checkAPIResultForErrors($result);
		return $result;
	}

	/**
	 * @internal
	 */
	public function _checkAPIResultForErrors($apiResult) {
		if(property_exists($apiResult, "errorCode") && $apiResult->errorCode != "") {
			$message = "[".$apiResult->errorCode."]";
			if(property_exists($apiResult, "errorMessage") && $apiResult->errorMessage != "") {
				$message .= " ".$apiResult->errorMessage;
			}
			throw new APIException($message, 0, null);
		}
	}

	public function newOrder($shippingKind="dropship"): Order {
		$order = new Order($this, $shippingKind);
		return $order;
	}

	public function getStockList() {
		$result = $this->_doGet("stock");
		return new StockList($result->items);
	}

	public function getShippingMethods() {
		$result = $this->_doGet("shipping_methods");
		return new ShippingMethods($result->methods);
	}

	public function uploadImage($imageData): string {
		$data = array(
			"image" => base64_encode($imageData),
		);
		$result = $this->_doPost("images", $data);
		return $result->reference;
	}

	public function getOrder($reference): OrderInfo {
		$result = $this->_doGet("orders/".$reference);
		return new OrderInfo($result);
	}

	public function getOrderByPartnerReference($reference): OrderInfo {
		$result = $this->_doGet("orders/by-partner-reference/".$reference);
		return new OrderInfo($result);
	}
}
