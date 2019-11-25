<?php

/**
 * Example how to get the details of a single address.
 */

use DigipolisGent\Flanders\BasicRegisters\BasicRegister;
use DigipolisGent\Flanders\BasicRegisters\Client\Client;
use DigipolisGent\Flanders\BasicRegisters\Configuration\Configuration;
use DigipolisGent\Flanders\BasicRegisters\Value\Address\AddressId;

require_once __DIR__ . '/bootstrap.php';

printTitle('Get the details of one address.');

printStep('Create the API client configuration.');
$configuration = new Configuration($apiEndpoint, $apiUserKey);

printStep('Create the Guzzle client.');
$guzzleClient = new GuzzleHttp\Client(['base_uri' => $configuration->getUri()]);

printStep('Create the HTTP client.');
$client = new Client($guzzleClient, $configuration);

printStep('Create the Service wrapper.');
$service = new BasicRegister($client);

printStep('Get the address details:');
$addressId = new AddressId($exampleAddressId);
$address = $service->address()->detail($addressId);

printBullet('Full address         : %s', (string) $address);
printBullet('Address ID           : %d', $address->addressId()->value());
printBullet('Street name ID       : %s', $address->streetName()->streetNameId()->value());
printBullet('Street name          : %s', $address->streetName()->name());
printBullet('House number         : %s', $address->houseNumber());
printBullet('Bus number           : %s', $address->busNumber());
printBullet('Post info ID         : %d', $address->municipality()->postInfoId()->value());
printBullet('Postal code          : %d', $address->municipality()->postalCode());
printBullet('Municipality name ID : %s', $address->municipality()->municipalityName()->name());
printBullet('Municipality name    : %d', $address->municipality()->municipalityName()->municipalityNameId()->value());

printFooter();
