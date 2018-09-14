<?php

namespace Invition\Partnerclient;

require_once(__DIR__."/DestinationAddress.php");

// The OrderInfo class contains all details of an existing order. It can be returned by the Client's getOrder method.
class OrderInfo {
	public $reference; // order reference, e.g. "TESTKEY-123"
	public $shippingKind; // shipping kind, e.g. "dropship" or "bulk"
	public $partnerReference; // custom partner reference, e.g. "abc_123"
	public $created; // creation date
	public $status; // status: "open" or "closed"
	public $destinationAddress; // contains DestinationAddress object when shipping_kind is "dropship"
	public $lines; // Array of OrderInfoLines
	public $shipments; // Array of OrderInfoShipments

	/**
	 * @internal
	 */
	public function __construct($data) {
		foreach($data as $key => $value) {
			switch($key) {
			case "reference":
				$this->reference = $value;
				break;
			case "shipping_kind":
				$this->shippingKind = $value;
				break;
			case "partner_reference":
				$this->partnerReference = $value;
				break;
			case "created":
				$this->created = $value;
				break;
			case "status":
				$this->status = $value;
				break;
			case "destination_address":
				$this->destinationAddress = new DestinationAddress($value);
				break;
			case "lines":
				$this->lines = [];
				foreach ($value as $i => $dataLine) {
					$line = new OrderInfoLine($dataLine);
					$this->lines[] = $line;
				}
				break;
			case "shipments":
				$this->shipments = [];
				foreach ($value as $i => $dataShipment) {
					$shipment = new OrderInfoShipment($dataShipment);
					$this->shipments[] = $shipment;
				}
				break;
			}
		}
	}
}

class OrderInfoLine {
	public $itemSKU;
	public $imageReference; // e.g. "TESTKEY-img-12"
	public $linenumber;
	public $quantity;
	public $canceledQuantity;
	public $shippedQuantity;

	/**
	 * @internal
	 */
	public function __construct($data) {
		foreach($data as $key => $value) {
			switch($key) {
			case "item_sku":
				$this->itemSKU = $value;
				break;
			case "image_reference":
				$this->imageReference = $value;
				break;
			case "linenumber":
				$this->linenumber = $value;
				break;
			case "quantity":
				$this->quantity = $value;
				break;
			case "canceled_quantity":
				$this->canceledQuantity = $value;
				break;
			case "shipped_quantity":
				$this->shippedQuantity = $value;
				break;
			}
		}
	}
}

class OrderInfoShipment {
	public $created; // time at which the shipment was created
	public $shipper; // shipper code, e.g. "GLS"
	public $trackAndTraceCode;
	public $trackAndTraceURL;
	public $shipmentLines; // Array of OrderInfoShipmentLine

	public function __construct($data) {
		foreach($data as $key => $value) {
			switch($key) {
			case "created":
				$this->created = $value;
				break;
			case "shipper":
				$this->shipper = $value;
				break;
			case "track_and_trace_code":
				$this->trackAndTraceCode = $value;
				break;
			case "track_and_trace_url":
				$this->trackAndTraceURL = $value;
				break;
			case "lines":
				$this->shipmentLines = [];
				foreach ($value as $i => $dataShipmentLine) {
					$shipmentLine = new OrderInfoShipmentLine($dataShipmentLine);
					$this->shipmentLines[] = $shipmentLine;
				}
			}
		}
	}
}

class OrderInfoShipmentLine {
	public $linenumber;
	public $quantity;

	public function __construct($data) {
		foreach($data as $key => $value) {
			switch($key) {
			case "linenumber":
				$this->linenumber = $value;
				break;
			case "quantity":
				$this->quantity = $value;
				break;
			}
		}
	}
}
