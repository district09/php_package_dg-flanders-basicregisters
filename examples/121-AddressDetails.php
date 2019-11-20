<?php

/**
 * Example how to get the details of a single address.
 */

use DigipolisGent\Flanders\BasicRegisters\Client\Client;
use DigipolisGent\Flanders\BasicRegisters\Configuration\Configuration;
use DigipolisGent\Flanders\BasicRegisters\BasicRegistersFactory;
use DigipolisGent\Flanders\BasicRegisters\Value\Address\AddressId;

require_once __DIR__ . '/bootstrap.php';

// Start output.
echo PHP_EOL;
echo str_repeat('-', 80) . PHP_EOL;
echo 'Get the details of one address.' . PHP_EOL;
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

echo ' → Get the address details.' . PHP_EOL;
$addressId = new AddressId($exampleAddressId);
$address = $service->addressDetail($addressId);

echo sprintf('   • Full address         : %s', (string) $address), PHP_EOL;
echo sprintf('   • Address ID           : %d', $address->addressId()->value()), PHP_EOL;
echo sprintf('   • Street name ID       : %s', $address->streetName()->streetNameId()->value()), PHP_EOL;
echo sprintf('   • Street name          : %s', $address->streetName()->name()), PHP_EOL;
echo sprintf('   • House number         : %s', $address->houseNumber()), PHP_EOL;
echo sprintf('   • Bus number           : %s', $address->busNumber()), PHP_EOL;
echo sprintf('   • Post info ID         : %d', $address->municipality()->postInfoId()->value()), PHP_EOL;
echo sprintf('   • Postal code          : %d', $address->municipality()->postalCode()), PHP_EOL;
echo sprintf('   • Municipality name ID : %s', $address->municipality()->municipalityName()->name()), PHP_EOL;
echo sprintf('   • Municipality name    : %d', $address->municipality()->municipalityName()->municipalityNameId()->value()), PHP_EOL;

// End.
echo PHP_EOL;
echo str_repeat('-', 80) . PHP_EOL;
echo PHP_EOL;
