<?php

/**
 * Example how to get a filtered list of addresses.
 *
 * @var string $apiEndpoint
 * @var string $apiUserKey
 * @var \Symfony\Component\Console\Output\ConsoleOutput $output
 */

use DigipolisGent\Flanders\BasicRegisters\BasicRegister;
use DigipolisGent\Flanders\BasicRegisters\Client\Client;
use DigipolisGent\Flanders\BasicRegisters\Configuration\Configuration;
use DigipolisGent\Flanders\BasicRegisters\Filter\Filters;
use DigipolisGent\Flanders\BasicRegisters\Filter\HouseNumberFilter;
use DigipolisGent\Flanders\BasicRegisters\Filter\MunicipalityNameFilter;
use DigipolisGent\Flanders\BasicRegisters\Filter\PostalCodeFilter;
use DigipolisGent\Flanders\BasicRegisters\Filter\StreetNameFilter;
use DigipolisGent\Flanders\BasicRegisters\Pager\Pager;
use Symfony\Component\Console\Helper\Table;

require_once __DIR__ . '/bootstrap.php';

printTitle('Get a list of the addresses from the service by filter and pager.');

printStep('Create the API client configuration.');
$configuration = new Configuration($apiEndpoint, $apiUserKey);

printStep('Create the Guzzle client.');
$guzzleClient = new GuzzleHttp\Client(['base_uri' => $configuration->getUri()]);

printStep('Create the HTTP client.');
$client = new Client($guzzleClient, $configuration);

printStep('Create the Service wrapper.');
$service = new BasicRegister($client);

printStep('Create the filters.');
$filters = new Filters(
    new MunicipalityNameFilter('Gent'),
    new PostalCodeFilter(9050),
    new StreetNameFilter('Bellevue'),
    new HouseNumberFilter(5)
);

printStep('Create the pager.');
$pager = new Pager(0, 50);

printStep('List of addresses:');
$addresses = $service->address()->list($filters, $pager);

$table = new Table($output);
$table->setHeaders(['ID', 'Address']);
foreach ($addresses as $address) {
    /** @var \DigipolisGent\Flanders\BasicRegisters\Value\Address\Address $address */
    $table->addRow(
        [
            (string) $address->addressId(),
            (string) $address,
        ]
    );
}
$table->render();

printFooter();
