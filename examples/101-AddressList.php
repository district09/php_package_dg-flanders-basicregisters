<?php

/**
 * Example how to get a list of addresses.
 */

use DigipolisGent\Flanders\BasicRegisters\BasicRegister;
use DigipolisGent\Flanders\BasicRegisters\Client\Client;
use DigipolisGent\Flanders\BasicRegisters\Configuration\Configuration;

require_once __DIR__ . '/bootstrap.php';

printTitle('Get a list of the first 20 addresses from the service.');

printStep('Create the API client configuration.');
$configuration = new Configuration($apiEndpoint, $apiUserKey);

printStep('Create the Guzzle client.');
$guzzleClient = new GuzzleHttp\Client(['base_uri' => $configuration->getUri()]);

printStep('Create the HTTP client.');
$client = new Client($guzzleClient, $configuration);

printStep('Create the Service wrapper.');
$service = new BasicRegister($client);

printStep('List of addresses.');
$addresses = $service->address()->list();

foreach ($addresses as $address) {
    /** @var \DigipolisGent\Flanders\BasicRegisters\Value\Address\Address $address */
    printBullet('%s : %s', $address->addressId(), (string) $address);
}

printFooter();
