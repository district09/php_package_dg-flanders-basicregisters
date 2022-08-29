<?php

/**
 * Example how to get the details of a single address.
 *
 * @var string $apiEndpoint
 * @var string $apiUserKey
 * @var string $exampleAddressId
 * @var \Symfony\Component\Console\Output\ConsoleOutput $output
 */

use DigipolisGent\Flanders\BasicRegisters\BasicRegister;
use DigipolisGent\Flanders\BasicRegisters\Client\Client;
use DigipolisGent\Flanders\BasicRegisters\Configuration\Configuration;
use DigipolisGent\Flanders\BasicRegisters\Value\Address\AddressId;
use Symfony\Component\Console\Helper\Table;

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

$table = new Table($output);
$table->addRows(
    [
        ['Full address', (string) $address],
        ['Address ID', (string) $address->addressId()],
        ['Street name ID', (string) $address->streetName()->streetNameId()],
        ['Street name', (string) $address->streetName()],
        ['House number', $address->houseNumber()],
        ['Bus number', $address->busNumber()],
        ['Post info ID', (string) $address->municipality()->postInfoId()],
        ['Postal code', $address->municipality()->postalCode()],
        ['Municipality name ID', (string) $address->municipality()->municipalityName()->municipalityNameId()],
        ['Municipality name', (string) $address->municipality()->municipalityName()],
    ]
);
$table->render();

printFooter();
