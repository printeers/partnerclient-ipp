<?php

namespace Invition\Partnerclient;

class StockList {
	// Array of StockItems
	public $items;

	/**
	 * @internal
	 */
	public function __construct($data) {
		foreach ($data as $i => $dataItem) {
			$item = new StockItem($dataItem);
			$this->items[] = $item;
		}
	}
}

class StockItem {
	public $id;
	public $dimensionID; // when an item has a dimensionID set, this means that a custom print image is required to order the item.
	public $dimensionWidthMM;
	public $dimensionHeightMM;
	public $sku;
	public $name;
	public $availability;
	public $public;
	
	/**
	 * @internal
	 */
	public function __construct($data) {
		foreach ($data as $key => $value) {
			switch($key) {
			case "id":
				$this->id = $value;
				break;
			case "dimension_id":
				$this->dimensionID = $value;
				break;
			case "dimension_width_mm":
				$this->dimensionWidthMM = $value;
				break;
			case "dimension_height_mm":
				$this->dimensionHeightMM = $value;
				break;
			case "sku":
				$this->sku = $value;
				break;
			case "name":
				$this->name = $value;
				break;
			case "availability":
				$this->availability = new StockItemAvailability($value);
				break;
			case "public":
				$this->public = $value;
				break;
			}
		}
	}
}

class StockItemAvailability {
	public $status; // one of: "in-stock", "low-stock", "out-of-stock"
	public $canBackorder; // boolean, indicates whether the item can be backordered
	public $amountLeft; // amount of stock left, only set when status = "low-stock"
	
	/**
	 * @internal
	 */
	public function __construct($data) {
		foreach ($data as $key => $value) {
			switch($key) {
			case "status":
				$this->status = $value;
				break;
			case "can_backorder":
				$this->canBackorder = $value;
				break;
			case "amount_left":
				$this->amountLeft = $value;
				break;
			}
		}
	}
}
