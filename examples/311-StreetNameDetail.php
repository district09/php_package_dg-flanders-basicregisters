<?php

/**
 * Example how to get the details of a single street name.
 */

use DigipolisGent\Flanders\BasicRegisters\BasicRegister;
use DigipolisGent\Flanders\BasicRegisters\Client\Client;
use DigipolisGent\Flanders\BasicRegisters\Configuration\Configuration;
use DigipolisGent\Flanders\BasicRegisters\Value\Street\StreetNameId;
use Symfony\Component\Console\Helper\Table;

require_once __DIR__ . '/bootstrap.php';

printTitle('Get the details of a single municipality name from the service.');

printStep('Create the API client configuration.');
$configuration = new Configuration($apiEndpoint, $apiUserKey);

printStep('Create the Guzzle client.');
$guzzleClient = new GuzzleHttp\Client(['base_uri' => $configuration->getUri()]);

printStep('Create the HTTP client.');
$client = new Client($guzzleClient, $configuration);

printStep('Create the Service wrapper.');
$service = new BasicRegister($client);

printStep('Street name details:');
$streetNameId = new StreetNameId($exampleStreetNameId);
$streetNameDetail = $service->streetName()->detail($streetNameId);

$table = new Table($output);
$table->addRows(
    [
        ['Street name ID', (string) $streetNameDetail->streetNameId()],
        ['Street name', (string) $streetNameDetail],
        ['Municipality name ID', (string) $streetNameDetail->municipalityName()->municipalityNameId()],
        ['Municipality name', (string) $streetNameDetail->municipalityName()],
    ]
);
$table->render();

printFooter();
