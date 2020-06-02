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
	public $kind;
	public $public;
	public $availability;
	public $exampleImages;
	public $suggestedRetailPrice;
	public $price;
	public $attributes;
	public $renderingLayers;
	
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
			case "kind":
				$this->kind = $value;
				break;
			case "public":
				$this->public = $value;
				break;
			case "availability":
				$this->availability = new StockItemAvailability($value);
				break;
			case "example_images":
				$this->exampleImages = $value;
				break;
			case "suggested_retail_price":
				$this->suggestedRetailPrice = $value;
				break;
			case "price":
				$this->price = $value;
				break;
			case "attributes":
				$this->attributes = new StockItemAttributes($value);
				break;
			case "rendering_layers":
				if (is_object($value)) {
					$this->renderingLayers = new StockItemRenderingLayers($value);
				}
				break;
			}
		}
	}
}

class StockItemAvailability {
	public $status; // one of: "in-stock", "low-stock", "out-of-stock"
	public $canBackorder; // boolean, indicates whether the item can be backordered
	public $amountLeft; // amount of stock left, only set when status = "low-stock"
	public $expectedAvailableDate; // when present this field contains the expected date on which Invition has the item available for printing and shipping.
	
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
			case "expected_available_date":
				$this->expectedAvailableDate = date_parse($value);
				break;
			}
		}
	}
}

class StockItemAttributes {
	public $printSide;
	public $printFinish;
	public $caseType;
	public $caseColour;
	public $deviceBrand;
	public $deviceModels;
	
	/**
	 * @internal
	 */
	public function __construct($data) {
		foreach ($data as $key => $value) {
			switch($key) {
			case "print_side":
				$this->printSide = $value;
				break;
			case "print_finish":
				$this->printFinish = $value;
				break;
			case "case_type":
				$this->caseType = $value;
				break;
			case "case_colour":
				$this->caseColour = $value;
				break;
			case "device_brand":
				$this->deviceBrand = $value;
				break;
			case "device_models":
				$this->deviceModels = $value;
				break;
			}
		}
	}
}

class StockItemRenderingLayers {
	public $maskURL; 
	public $mockupURL;
	public $topURL;
	public $bottomURL;
	public $ppmm;
	
	/**
	 * @internal
	 */
	public function __construct($data) {
		foreach ($data as $key => $value) {
			switch($key) {
			case "mask_url":
				$this->maskURL = $value;
				break;
			case "mockup_url":
				$this->mockupURL = $value;
				break;
			case "top_url":
				$this->topURL = $value;
				break;
			case "bottom_url":
				$this->bottomURL = $value;
				break;
			case "ppmm":
				$this->ppmm = $value;
				break;
			}
		}
	}
}
