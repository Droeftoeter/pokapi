<?php
/**
 * Small example for now.
 */
require __DIR__ . '/vendor/autoload.php';

$settings = include 'config.php';
$auth = new \Pokapi\Authentication\TrainersClub($settings['username'], $settings['password']);

$steps = \Pokapi\Utility\Geo::generateSteps($settings['latitude'], $settings['longitude'], 5);

$api = new \Pokapi\API($auth, $settings['latitude'], $settings['longitude'], $settings['altitude']);

foreach ($steps as $index => $step) {
    $api->setLocation($step[0], $step[1], $settings['altitude']);
    $response = $api->getMapObjects();
    /** @var \POGOProtos\Map\MapCell $mapCell */
    foreach ($response->getMapCellsArray() as $mapCell) {
        if ($mapCell->getWildPokemonsCount() > 0) {
            $wildPokemons = $mapCell->getWildPokemonsArray();

            /** @var \POGOProtos\Map\Pokemon\WildPokemon $wildPokemon */
            foreach ($wildPokemons as $wildPokemon) {
                echo "Wild " . \POGOProtos\Enums\PokemonId::$_values[$wildPokemon->getPokemonData()->getPokemonId()] . " found at " . $wildPokemon->getLatitude() . ", " . $wildPokemon->getLongitude() . "\r\n";
            }
        }
    }
    sleep(1);
}
