<?php

namespace Invition\Partnerclient;

/**
 * DestinationAddress contains the address details for an order.
 */
class DestinationAddress implements \JsonSerializable {
	/**
	 * First name of the recipient
	 * Max 100 characters.
	 */
	public $firstname; // John

	/**
	 * Lastname of the recipient.
	 * Max 100 characters.
	 */
	public $lastname; // Doe

	/**
	 * Company name of the recipient, can be empty.
	 * max 100 characters.
	 */
	public $company; // Invition

	/**
	 * Streetname, max 100 characters.
	 */
	public $streetname; // Otterkoog

	/**
	 * Housenumber excluding suffix, as a string.
	 * Max 50 characters.
	 */
	public $housenumber; // 7

	/**
	 * Housenumber suffix/addition, as a string.
	 * Max 50 characters.
	 */
	public $housenumberAddition; // A

	/**
	 * Additional info, may be set to address 2 for US addresses.
	 * Max 40 characters
	 */
	public $additionalInfo; // "Second doorbell" or "PO box 12345"

	/**
	 * Destination city, max 100 characters.
	 */
	public $city; // Alkmaar

	/**
	 * State, if applicable. Max length 100 characters.
	 */
	public $state;

	/**
	 * Zipcode or postalcode. max length 20 characters.
	 */
	public $zipcode; // 1822 BW

	/**
	 * Country 2-character code, must be set to a valid value such as "NL".
	 */
	public $countryCode;

	/**
	 * Phonenumber, the phonenumber at which the recipient of a package may be contacted.
	 * Can be in national or international format.
	 * Max length 20 characters.
	 */
	public $phonenumber; // +31612345678

	/**
	 * Email address, the e-mail address at which the recipient of a package may be contacted.
	 * Max length 50 characters.
	 */
	public $email; // someone@domain.example

	/**
	 * @internal
	 */
	public function __construct($data=null) {
		if($data===null) {
			return;
		}
		foreach ($data as $key => $value) {
			switch($key) {
		 	case "firstname":
			 	$this->firstname = $value;
				break;
		 	case "lastname":
			 	$this->lastname = $value;
				break;
		 	case "company":
			 	$this->company = $value;
				break;
		 	case "streetname":
			 	$this->streetname = $value;
				break;
		 	case "housenumber":
			 	$this->housenumber = $value;
				break;
		 	case "housenumber_addition":
			 	$this->housenumberAddition = $value;
			case "additional_info":
				$this->additionalInfo = $value;
				break;
		 	case "city":
			 	$this->city = $value;
				break;
		 	case "state":
			 	$this->state = $value;
				break;
		 	case "zipcode":
			 	$this->zipcode = $value;
				break;
		 	case "country_code":
			 	$this->countryCode = $value;
			case "phonenumber":
				$this->phonenumber = $value;
			case "email":
				$this->email = $value;
				break;
			}
		}
	}

	public function jsonSerialize() {
		return array(
			"firstname" => $this->firstname,
			"lastname" => $this->lastname,
			"company" => $this->company,
			"streetname" => $this->streetname,
			"housenumber" => $this->housenumber,
			"housenumber_addition" => $this->housenumberAddition,
		 	"additional_info" => $this->additionalInfo,
			"city" => $this->city,
			"state" => $this->state,
			"zipcode" => $this->zipcode,
			"country_code" => $this->countryCode,
			"phonenumber" => $this->phonenumber,
			"email" => $this->email,
		);
	}
}
