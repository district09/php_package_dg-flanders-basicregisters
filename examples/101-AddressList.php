<?php

/**
 * Example how to get a list of addresses.
 */

use DigipolisGent\Flanders\BasicRegisters\Client\Client;
use DigipolisGent\Flanders\BasicRegisters\Configuration\Configuration;
use DigipolisGent\Flanders\BasicRegisters\BasicRegistersFactory;

require_once __DIR__ . '/bootstrap.php';

// Start output.
echo PHP_EOL;
echo str_repeat('-', 80) . PHP_EOL;
echo 'Get a list of the first 20 addresses from the service.' . PHP_EOL;
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

echo ' → List of addresses.' . PHP_EOL;
$addresses = $service->addressList();

foreach ($addresses as $address) {
    /** @var \DigipolisGent\Flanders\BasicRegisters\Value\Address\Address $address */
    echo sprintf('   • %d : %s', $address->addressId()->value(), (string) $address);
    echo PHP_EOL;
}

echo PHP_EOL;

// End.
echo PHP_EOL;
echo str_repeat('-', 80) . PHP_EOL;
echo PHP_EOL;
