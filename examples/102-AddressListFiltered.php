<?php

/**
 * Example how to get a (filtered) list of lodgings.
 */

use DigipolisGent\Flanders\BasicRegisters\Client\Client;
use DigipolisGent\Flanders\BasicRegisters\Configuration\Configuration;
use DigipolisGent\Flanders\BasicRegisters\BasicRegistersFactory;
use DigipolisGent\Flanders\BasicRegisters\Filter\Filters;
use DigipolisGent\Flanders\BasicRegisters\Filter\HouseNumberFilter;
use DigipolisGent\Flanders\BasicRegisters\Filter\LocalityNameFilter;
use DigipolisGent\Flanders\BasicRegisters\Filter\PostalCodeFilter;
use DigipolisGent\Flanders\BasicRegisters\Filter\StreetNameFilter;
use DigipolisGent\Flanders\BasicRegisters\Pager\Pager;

require_once __DIR__ . '/bootstrap.php';

// Start output.
echo PHP_EOL;
echo str_repeat('-', 80) . PHP_EOL;
echo 'Get a list of the addresses from the service by filter and pager.' . PHP_EOL;
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

echo ' → Create the filters.' . PHP_EOL;
$filters = new Filters(
    new LocalityNameFilter('Gent'),
    new PostalCodeFilter(9050),
    new StreetNameFilter('Bellevue'),
    new HouseNumberFilter(5)
);

echo ' → Create the pager.' . PHP_EOL;
$pager = new Pager(0, 50);

echo ' → List of addresses.' . PHP_EOL;
$addresses = $service->addressList($filters, $pager);

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
