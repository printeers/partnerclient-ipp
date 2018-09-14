<?php

namespace Invition\Partnerclient;

class ShippingMethods {
	// Array of ShippingMethods
	public $methods;

	/**
	 * @internal
	 */
	public function __construct($data) {
		foreach ($data as $i => $dataMethod) {
			$method = new ShippingMethod($dataMethod);
			$this->methods[] = $method;
		}
	}
}

class ShippingMethod {
	public $id;
	public $name;
	public $type;
	
	/**
	 * @internal
	 */
	public function __construct($data) {
		foreach ($data as $key => $value) {
			switch($key) {
			case "id":
				$this->id = $value;
				break;
			case "name":
				$this->name = $value;
				break;
			case "type":
				$this->type = $value;
				break;
			}
		}
	}
}