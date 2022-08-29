<?php

/**
 * Example how to get the details of a single municipality name.
 *
 * @var string $apiEndpoint
 * @var string $apiUserKey
 * @var string $exampleMunicipalityNameId
 * @var \Symfony\Component\Console\Output\ConsoleOutput $output
 */

use DigipolisGent\Flanders\BasicRegisters\BasicRegister;
use DigipolisGent\Flanders\BasicRegisters\Client\Client;
use DigipolisGent\Flanders\BasicRegisters\Configuration\Configuration;
use DigipolisGent\Flanders\BasicRegisters\Value\Municipality\MunicipalityNameId;
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

printStep(' Municipality name details.');
$municipalityNameId = new MunicipalityNameId($exampleMunicipalityNameId);
$municipalityName = $service->municipalityName()->detail($municipalityNameId);

$table = new Table($output);
$table->addRows(
    [
        ['Municipality name ID', (string) $municipalityName->municipalityNameId()],
        ['Municipality name', (string) $municipalityName],
    ]
);
$table->render();

printFooter();
