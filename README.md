# PHP Pokemon Go API

Pokemon API PHP.
Not finished at all so far.

Supports request signing.

## Hashing Server
Pokapi now supports the use of a Hashing Server, see Usage.

## Requirements

- PHP 7.1+
- [php-xxhash](https://github.com/MatthewKingDev/php-xxhash) extension
- 64-bit PHP
- Hashing server if you want to use the latest version (0.57.2)

## Installation

To install with Composer

```composer require sjaakmoes/pokapi```

## Usage
```php
// PTC Account
$authentication = new TrainersClub('username', 'password');
$position = new Position($latitude, $longitude, $altitude);
$deviceInfo = DeviceInfo::getDefault($uniqueDeviceId);
  
// Version  
$version = new Version\Latest(); // 0.57.2 - You need a hashing server for this one.  
$version = new Version\Legacy(); // 0.45.0  
 
// Pogodev.io hashing server  
$hashProvider = new Hashing\Pogodev("your_api_key_here");  
  
$api = new API($version, $authentication, $position, $deviceInfo, $hashProvider);  
  
// Initializes like the real client
$api->initialize();
  
// Accept ToS
$api->acceptTerms();
  
// Execute operation
$getPlayerResponse = $api->getPlayerData();
$mapObjects = $api->getMapObjects();
```
