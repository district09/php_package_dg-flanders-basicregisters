<?php

/**
 * Example how to use the AddressMatch service method.
 */

use DigipolisGent\Flanders\BasicRegisters\Client\Client;
use DigipolisGent\Flanders\BasicRegisters\Configuration\Configuration;
use DigipolisGent\Flanders\BasicRegisters\BasicRegistersFactory;
use DigipolisGent\Flanders\BasicRegisters\Filter\Filters;
use DigipolisGent\Flanders\BasicRegisters\Filter\HouseNumberFilter;
use DigipolisGent\Flanders\BasicRegisters\Filter\LocalityNameFilter;
use DigipolisGent\Flanders\BasicRegisters\Filter\PostalCodeFilter;
use DigipolisGent\Flanders\BasicRegisters\Filter\StreetNameFilter;

require_once __DIR__ . '/bootstrap.php';

// Start output.
echo PHP_EOL;
echo str_repeat('-', 80) . PHP_EOL;
echo 'Get a list of all addresses in Gent with belle in the street name.' . PHP_EOL;
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
    new LocalityNameFilter('gent'),
    new PostalCodeFilter(9000),
    new StreetNameFilter('bellevue'),
    new HouseNumberFilter(5)
);

echo ' → List of address that match the search.' . PHP_EOL;
$addressMatches = $service->addressMatch($filters);

foreach ($addressMatches as $addressMatch) {
    /** @var \DigipolisGent\Flanders\BasicRegisters\Value\Address\AddressMatch $addressMatch */
    echo sprintf('   • %s', (string) $addressMatch), PHP_EOL;
    echo sprintf('     Locality name ID : %s', $addressMatch->localityName()->localityNameId()), PHP_EOL;
    echo sprintf('     Locality name    : %s', $addressMatch->localityName()), PHP_EOL;
    echo sprintf('     Street name ID   : %s', $addressMatch->streetName()->streetNameId()), PHP_EOL;
    echo sprintf('     Street name      : %s', $addressMatch->streetName()), PHP_EOL;
    echo sprintf('     Address ID       : %s', $addressMatch->addressDetail() ?? 'NA'), PHP_EOL;
    echo sprintf('     Match Score      : %s', $addressMatch->score()), PHP_EOL;
}

// End.
echo PHP_EOL;
echo str_repeat('-', 80) . PHP_EOL;
echo PHP_EOL;
