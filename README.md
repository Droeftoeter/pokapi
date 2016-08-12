# PHP Pokemon Go API
Pokemon API PHP.
Not finished at all so far.

Supports request signing

## Requirements

- PHP 7.0+
- [php-xxhash](https://github.com/MatthewKingDev/php-xxhash) extension

## Installation

To install with Composer

```composer require sjaakmoes/pokapi```

## Usage
```php
$authentication = new TrainersClub('username', 'password');
$api = new API($authentication, $latitude, $longitude, $altitude);

// Initializes like the real client
$api->initialize();

// Accept ToS
$api->acceptTerms();

// Execute operation
$getPlayerResponse = $api->getPlayerData();
$mapObjects = $api->getMapObjects();
```
