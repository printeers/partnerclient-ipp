Invition\Partnerclient\DestinationAddress
===============

DestinationAddress contains the address details for an order.




* Class name: DestinationAddress
* Namespace: Invition\Partnerclient
* This class implements: JsonSerializable




Properties
----------


### $firstname

    public mixed $firstname

First name of the recipient
Max 100 characters.



* Visibility: **public**


### $lastname

    public mixed $lastname

Lastname of the recipient.

Max 100 characters.

* Visibility: **public**


### $company

    public mixed $company

Company name of the recipient, can be empty.

max 100 characters.

* Visibility: **public**


### $streetname

    public mixed $streetname

Streetname, max 100 characters.



* Visibility: **public**


### $housenumber

    public mixed $housenumber

Housenumber excluding suffix, as a string.

Max 50 characters.

* Visibility: **public**


### $housenumberAddition

    public mixed $housenumberAddition

Housenumber suffix/addition, as a string.

Max 50 characters.

* Visibility: **public**


### $city

    public mixed $city

Destination city, max 100 characters.



* Visibility: **public**


### $state

    public mixed $state

State, if applicable. Max length 100 characters.



* Visibility: **public**


### $zipcode

    public mixed $zipcode

Zipcode or postalcode. max length 20 characters.



* Visibility: **public**


### $countryCode

    public mixed $countryCode

Country 2-character code, must be set to a valid value such as "NL".



* Visibility: **public**


Methods
-------


### jsonSerialize

    mixed Invition\Partnerclient\DestinationAddress::jsonSerialize()





* Visibility: **public**



