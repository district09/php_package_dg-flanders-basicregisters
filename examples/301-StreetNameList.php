<?php

/**
 * Example how to get a list of street names.
 */

use DigipolisGent\Flanders\BasicRegisters\BasicRegister;
use DigipolisGent\Flanders\BasicRegisters\Client\Client;
use DigipolisGent\Flanders\BasicRegisters\Configuration\Configuration;
use DigipolisGent\Flanders\BasicRegisters\Filter\Filters;
use DigipolisGent\Flanders\BasicRegisters\Filter\MunicipalityNameFilter;
use DigipolisGent\Flanders\BasicRegisters\Pager\Pager;

require_once __DIR__ . '/bootstrap.php';

// Start output.
echo PHP_EOL;
echo str_repeat('-', 80) . PHP_EOL;
echo 'Get a list of the first 25 street names in Gent from the service.' . PHP_EOL;
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

echo ' → List of street names.' . PHP_EOL;
$filters = new Filters(new MunicipalityNameFilter('gent'));
$streetNames = $service->streetName()->list($filters, new Pager(0, 25));

foreach ($streetNames as $streetName) {
    /** @var \DigipolisGent\Flanders\BasicRegisters\Value\Street\StreetName $municipalityName */
    echo sprintf('   • %s : %s', $streetName->streetNameId(), $streetName);
    echo PHP_EOL;
}

// End.
echo PHP_EOL;
echo str_repeat('-', 80) . PHP_EOL;
echo PHP_EOL;
