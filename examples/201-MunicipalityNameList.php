<?php

/**
 * Example how to get a list of municipality names.
 */

use DigipolisGent\Flanders\BasicRegisters\BasicRegister;
use DigipolisGent\Flanders\BasicRegisters\Client\Client;
use DigipolisGent\Flanders\BasicRegisters\Configuration\Configuration;
use DigipolisGent\Flanders\BasicRegisters\Pager\Pager;
use Symfony\Component\Console\Helper\Table;

require_once __DIR__ . '/bootstrap.php';

printTitle('Get a list of the first 25 municipality names from the service.');

printStep('Create the API client configuration.');
$configuration = new Configuration($apiEndpoint, $apiUserKey);

printStep('Create the Guzzle client.');
$guzzleClient = new GuzzleHttp\Client(['base_uri' => $configuration->getUri()]);

printStep('Create the HTTP client.');
$client = new Client($guzzleClient, $configuration);

printStep('Create the Service wrapper.');
$service = new BasicRegister($client);

printStep('List of municipality names:');
$municipalityNames = $service->municipalityName()->list(new Pager(0, 25));

$table = new Table($output);
$table->setHeaders(['ID', 'Municipality name']);
foreach ($municipalityNames as $municipalityName) {
    /** @var \DigipolisGent\Flanders\BasicRegisters\Value\Municipality\MunicipalityName $municipalityName */
    $table->addRow(
        [
            (string) $municipalityName->municipalityNameId(),
            (string) $municipalityName,
        ]
    );
}
$table->render();

printFooter();
