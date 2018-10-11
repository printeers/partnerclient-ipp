## Changelog

This document describes changes made to the partnerclient over time.

### 2018-10-11 16:00

- **BREAKING CHANGE** Remove need for shipping methods, add shipping level.

### 2018-09-17 14:00

- **BREAKING CHANGE** Rebuild client to Composer directory structure (PSR-4)
- **BREAKING CHANGE** Namespace changed to Invition/Partnerclient

### 2017-10-12 12:00

- Add housenumberAddition. This can be used to separately send the suffix/addition of a housenumber which improves shipment labels.
- Add partner reference, an optional field to identify and retrieve orders.

### 2017-09-28 12:30

- Improved examples

### 2017-09-21 14:00

- **BREAKING CHANGE** Simplified the uploadImage() call, first parameter ($dimension_id) has been removed.

#### Aanpassingen controle afbeeldingen

De controle op dimensies van afbeeldingen is komen te vervallen. Zodra een afbeelding te breed of te hoog is zullen we deze gecentreerd croppen.
De afmetingen van een stockitem blijven beschikbaar in de API, daarnaast zullen we altijd per mail communiceren zodra een print afmeting aangepast word. Omdat met het vervallen van deze controle het niet meer nodig is te weten voor welke dimension_id een afbeelding is geupload, is dit veld vervallen in de API.

#### Nieuwe partner client.

Bovenstaande aanpassingen zijn doorgevoerd in de PHP Partnerclient.
LET OP: met deze nieuwe partnerclient zijn aanpassingen nodig in het gebruik ervan!
De uploadImage functie is aangepast. Voorheen had deze twee parameters: `$dimension_id` en `$imageBytes`. De eerste parameter is komen te vervallen. Voorbeeld van het nieuwe gebruik:
`$client->uploadImage($imageBytes)`
