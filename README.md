# PHP Pokemon Go API

Pokemon API PHP.
Not finished at all so far.

Supports request signing.

## Requirements

- PHP 7.0+
- [php-xxhash](https://github.com/MatthewKingDev/php-xxhash) extension
- 64-bit PHP

## Installation

To install with Composer

```composer require sjaakmoes/pokapi```

## Usage
```php
$authentication = new TrainersClub('username', 'password');
$position = new Position($latitude, $longitude, $altitude);
$deviceInfo = DeviceInfo::getDefault($uniqueDeviceId);
$api = new API($authentication, $position, $deviceInfo);

// Initializes like the real client
$api->initialize();

// Accept ToS
$api->acceptTerms();

// Execute operation
$getPlayerResponse = $api->getPlayerData();
$mapObjects = $api->getMapObjects();
```
