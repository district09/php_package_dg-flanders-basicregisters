<?php

/**
 * Example how to get a list of street names.
 */

use DigipolisGent\Flanders\BasicRegisters\BasicRegister;
use DigipolisGent\Flanders\BasicRegisters\Client\Client;
use DigipolisGent\Flanders\BasicRegisters\Configuration\Configuration;
use Symfony\Component\Console\Helper\Table;

require_once __DIR__ . '/bootstrap.php';

printTitle('Get a list of the first 20 street names from the service.');

printStep('Create the API client configuration.');
$configuration = new Configuration($apiEndpoint, $apiUserKey);

printStep('Create the Guzzle client.');
$guzzleClient = new GuzzleHttp\Client(['base_uri' => $configuration->getUri()]);

printStep('Create the HTTP client.');
$client = new Client($guzzleClient, $configuration);

printStep('Create the Service wrapper.');
$service = new BasicRegister($client);

printStep('List of street names:');
$postInfos = $service->streetName()->list();

$table = new Table($output);
$table->setHeaders(['ID', 'Street name']);
foreach ($postInfos as $streetName) {
    /** @var \DigipolisGent\Flanders\BasicRegisters\Value\Street\StreetName $streetName */
    $table->addRow(
        [
            (string) $streetName->streetNameId(),
            (string) $streetName,
        ]
    );
}
$table->render();

printFooter();
