<?php

/**
 * Example how to get a list of municipality names.
 */

use DigipolisGent\Flanders\BasicRegisters\Client\Client;
use DigipolisGent\Flanders\BasicRegisters\Configuration\Configuration;
use DigipolisGent\Flanders\BasicRegisters\BasicRegistersFactory;
use DigipolisGent\Flanders\BasicRegisters\Pager\Pager;

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
$service = BasicRegistersFactory::create($client);

echo ' → List of municipality names.' . PHP_EOL;
$municipalityNames = $service->municipalityNames(new Pager(0, 25));

foreach ($municipalityNames as $municipalityName) {
    /** @var \DigipolisGent\Flanders\BasicRegisters\Value\Municipality\MunicipalityName $municipalityName */
    echo sprintf('   • %s : %s', $municipalityName->municipalityNameId(), $municipalityName);
    echo PHP_EOL;
}

// End.
echo PHP_EOL;
echo str_repeat('-', 80) . PHP_EOL;
echo PHP_EOL;
