<?php

namespace Invition\Partnerclient;

require_once(__DIR__ . '/DestinationAddress.php');
require_once(__DIR__ . '/Exception.php');

// Class Order can be used to create new orders.
// Note that this class is not used to get updates on an existing order, see the OrderInfo class for those details.
class Order {
	private $client;

	/**
	 * @internal
	 */
	public function __construct(Client &$client, $shippingKind) {
		$this->client = $client;
		
		switch($shippingKind) {
			case "dropship":
			case "bulk":
				// valid values
				break;
			default:
				throw new Exception("invalid shippingKind, epxecting 'dropship' or 'bulk'");
				break;
		}
		$this->shippingKind = $shippingKind;
	}

	private $lineref = 0;
	private $lines;
	
	private $shippingKind; // set by constructor, default to "dropship"
	
	private $destinationAddress = null;
	private $shippingMethodID = 0;

	private $reference = "";
	private $customReference = null;

	public function addLine(string $itemSKU, int $quantity): OrderLine {
		if($this->reference != 0) {
			throw new Exception("order already executed");
		}

		$line = new OrderLine($this, $itemSKU, $quantity);
		$this->lines[$line->_getRef()] = $line;
		return $line;
	}

	/**
	 * @internal
	 */
	public function _nextLineRef(): int {
		$ref = $this->lineref++;
		return $ref;
	}

	/**
	 * removeLine removes given orderline from the current order.
	 * When an orderline is not related to the order (anymore), this throws an $invitionExceptionLineDoesNotBelongToThisOrder;
	 */
	public function removeLine(OrderLine &$line) {
		if($this->reference != "") {
			throw new Exception("order already executed");
		}

		if($line->_getOrder() !== $this) {
			throw new Exception ("line does not belong to this order");
		}
		if(!array_key_exists($line->_getRef(), $this->lines)){
			throw new Exception ("line does not belong to this order");
		}
		unset($this->lines[$line->_getRef()]);
	}

	/**
	 * orderLines returns an array of OrderLine objects.
	 * Modifications to the array are not saved, to change the order lines, use
	 * AddLine and RemoveLine.
	 */
	public function orderLines(): array{
		return $this->lines;
	}

	public function setDestinationAddress(DestinationAddress $destinationAddress) {
		if($this->shippingKind != "dropship") {
			throw new Exception('cannot set destination address on non-dropship order');
		}
		if($this->reference != "") {
			throw new Exception("order already executed");
		}

		$this->destinationAddress = $destinationAddress;
	}

	public function setShippingMethod(int $shippingMethodID) {
		if($this->shippingKind != "dropship") {
			throw new Exception("cannot set shipping method on non-dropship order");
		}
		if($this->reference != "") {
			throw new Exception("order already executed");
		}

		$this->shippingMethodID = $shippingMethodID;
	}

	public function setPartnerReference(string $partnerReference) {
		if($this->reference != "") {
			throw new Exception("order already executed");
		}

		$this->partnerReference = $partnerReference;
	}

	/**
	 * execute sends the order to Invition.
	 * When an error occurs, the error object is returned.
	 */
	public function execute() {
		if($this->reference != "") {
			throw new Exception("order already executed");
		}

		if($this->shippingKind == "dropship" && $this->destinationAddress == null) {
			throw new Exception("missing destination address");
		}
		if(count($this->lines) == 0) {
			throw new Exception("no order lines");
		}
		// TODO: move to JsonSerializable impl and just json_encode($this);
		$data = array(
			"shipping_kind" => $this->shippingKind,
			"lines" => $this->lines,
		);
		if($this->partnerReference != null) {
			$data["partner_reference"] = $this->partnerReference;
		}
		if($this->destinationAddress != null) {
			$data["address"] = $this->destinationAddress;
		}
		if($this->shippingMethodID != 0) {
			$data["shipping_method_id"] = $this->shippingMethodID;
		}
		$result = $this->client->_doPost("orders", $data);
		$this->reference = $result->reference;
		return null;
	}

	/**
	 * getOrderReference returns the order reference of an order that has been executed.
	 */
	public function getReference(): string {
		if($this->reference == "") {
			throw new Exception("order not executed yet");
		}

		return $this->reference;
	}
}

class OrderLine implements \JsonSerializable {
	private $order;
	private $ref; // internal reference fore use in this library
	private $itemSKU;
	private $quantity;
	private $imageReference;

	/**
	 * @internal
	 */
	public function __construct(Order &$order, string $itemSKU, int $quantity){
		$this->order = $order;
		$this->ref = $order->_nextLineRef();
		$this->itemSKU = $itemSKU;
		$this->quantity = $quantity;
	}

    public function jsonSerialize() {
        $data = array(
			"item_sku" => $this->itemSKU,
			"quantity" => $this->quantity,
		);
		if($this->imageReference != "") {
			$data["image_reference"] = $this->imageReference;
		}
		return $data;
    }

	/**
	 * @internal
	 */
	public function _getOrder(): Order {
		return $this->order;
	}

	/**
	 * @internal
	 */
	public function _getRef(): int {
		return $this->ref;
	}

	public function setImageReference(string $imageReference) {
		$this->imageReference = $imageReference;
	}
}
