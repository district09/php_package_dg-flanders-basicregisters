<?php

/**
 * Example how to get the details of a single municipality name.
 */

use DigipolisGent\Flanders\BasicRegisters\BasicRegister;
use DigipolisGent\Flanders\BasicRegisters\Client\Client;
use DigipolisGent\Flanders\BasicRegisters\Configuration\Configuration;
use DigipolisGent\Flanders\BasicRegisters\Pager\Pager;
use DigipolisGent\Flanders\BasicRegisters\Value\Municipality\MunicipalityNameId;

require_once __DIR__ . '/bootstrap.php';

// Start output.
echo PHP_EOL;
echo str_repeat('-', 80) . PHP_EOL;
echo 'Get a list of the first 25 municipality names from the service.' . PHP_EOL;
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

echo ' → Municipality name details.' . PHP_EOL;
$municipalityNameId = new MunicipalityNameId($exampleMunicipalityNameId);
$municipalityNameDetail = $service->municipalityName()->detail($municipalityNameId);

echo sprintf('   • ID      : %d', $municipalityNameDetail->municipalityNameId()->value()), PHP_EOL;

foreach ($municipalityNameDetail->geographicalNames() as $geographicalName) {
    /** @var \DigipolisGent\Flanders\BasicRegisters\Value\Geographical\GeographicalName $geographicalName */
    echo sprintf('   • Name %s : %s', $geographicalName->languageCode(), $geographicalName), PHP_EOL;
}

// End.
echo PHP_EOL;
echo str_repeat('-', 80) . PHP_EOL;
echo PHP_EOL;
