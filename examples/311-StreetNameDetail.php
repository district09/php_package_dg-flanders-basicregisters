<?php

/**
 * Example how to get the details of a single street name.
 */

use DigipolisGent\Flanders\BasicRegisters\BasicRegister;
use DigipolisGent\Flanders\BasicRegisters\Client\Client;
use DigipolisGent\Flanders\BasicRegisters\Configuration\Configuration;
use DigipolisGent\Flanders\BasicRegisters\Value\Municipality\MunicipalityNameId;
use DigipolisGent\Flanders\BasicRegisters\Value\Street\StreetNameId;

require_once __DIR__ . '/bootstrap.php';

// Start output.
echo PHP_EOL;
echo str_repeat('-', 80) . PHP_EOL;
echo 'Get the details of a single municipality name from the service.' . PHP_EOL;
echo str_repeat('-', 80) . PHP_EOL;
echo PHP_EOL;

echo ' → Create the API client configuration.' . PHP_EOL;
$configuration = new Configuration($apiEndpoint, $apiUserKey);

echo ' → Create the Guzzle client.' . PHP_EOL;
$guzzleClient = new GuzzleHttp\Client(['base_uri' => $configuration->getUri()]);

echo ' → Create the HTTP client.' . PHP_EOL;
$client = new Client($guzzleClient, $configuration);

echo ' → Create the Service wrapper.' . PHP_EOL;
$service = new BasicRegister($client);

echo ' → Street name details.' . PHP_EOL;
$streetNameId = new StreetNameId($exampleStreetNameId);
$streetNameDetail = $service->streetName()->detail($streetNameId);

echo sprintf('   • ID           : %d', $streetNameDetail->streetNameId()->value()), PHP_EOL;
echo sprintf(
    '   • Municipality : %s %s',
    $streetNameDetail->municipalityName()->municipalityNameId(),
    $streetNameDetail->municipalityName()
), PHP_EOL;

foreach ($streetNameDetail->geographicalNames() as $geographicalName) {
    /** @var \DigipolisGent\Flanders\BasicRegisters\Value\Geographical\GeographicalName $geographicalName */
    echo sprintf('   • Name %s      : %s', $geographicalName->languageCode(), $geographicalName), PHP_EOL;
}

// End.
echo PHP_EOL;
echo str_repeat('-', 80) . PHP_EOL;
echo PHP_EOL;
