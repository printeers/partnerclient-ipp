<?php

namespace Invition\Partnerclient;

class Exception extends \Exception{};
//
// // Thrown when a Client is instantiated with an invalid environment value.
// $invitionExceptionInvalidEnvironment = new Exception("invalid environment");
//
// // Thrown when Order->RemoveLine was called with an OrderLine belonging to a different order.
// // Or when the OrderLine was already removed from that Order.
// $invitionExceptionLineDoesNotBelongToThisOrder = new Exception("line does not belong to this order");
//
// // Thrown when Order->Execute finds that no destination address has been set.
// $invitionExceptionMissingDestinationAddress = new Exception("missing destination address");
//
// // Thrown when Order->Execute finds that no order lines are present on the order.
// $invitionExceptionNoOrderLines = new Exception("no order lines");
//
// // Thrown when an order must not be executed when the method throwing the exception is called.
// $invitionExceptionOrderAlreadyExecuted = new Exception("order has already been executed");
//
// // Thrown when an order must be executed before the method throwing the exception is called.
// $invitionExceptionOrderNotExecutedYet = new Exception("order not executed yet");


class APIException extends \Exception{
	public function __toString() {
		return __CLASS__ . ": {$this->message}\n";
	}
}