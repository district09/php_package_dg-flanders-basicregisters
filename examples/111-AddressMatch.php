<?php

/**
 * Example how to use the AddressMatch service method.
 */

use DigipolisGent\Flanders\BasicRegisters\BasicRegister;
use DigipolisGent\Flanders\BasicRegisters\Client\Client;
use DigipolisGent\Flanders\BasicRegisters\Configuration\Configuration;
use DigipolisGent\Flanders\BasicRegisters\Filter\BusNumberFilter;
use DigipolisGent\Flanders\BasicRegisters\Filter\Filters;
use DigipolisGent\Flanders\BasicRegisters\Filter\HouseNumberFilter;
use DigipolisGent\Flanders\BasicRegisters\Filter\MunicipalityNameFilter;
use DigipolisGent\Flanders\BasicRegisters\Filter\PostalCodeFilter;
use DigipolisGent\Flanders\BasicRegisters\Filter\StreetNameFilter;
use Symfony\Component\Console\Helper\Table;

require_once __DIR__ . '/bootstrap.php';

printTitle('Get a list of all addresses in Gent with belle in the street name.');

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
    new MunicipalityNameFilter('gent'),
    new PostalCodeFilter(9000),
    new StreetNameFilter('Ter Platen'),
    new HouseNumberFilter(64),
    new BusNumberFilter('')
);

printStep('List of address that match the search.');
$addressMatches = $service->address()->match($filters);

$table = new Table($output);
$table->setHeaders(
    [
        'Match',
        'Address ID',
        'Municipality (ID)',
        'Street name (ID)',
        'Score',
    ]
);
foreach ($addressMatches as $addressMatch) {
    /** @var \DigipolisGent\Flanders\BasicRegisters\Value\Address\AddressMatch $addressMatch */
    $table->addRow(
        [
            (string) $addressMatch,
            $addressMatch->addressDetail() ? (string) $addressMatch->addressDetail()->addressId() : 'NA',
            sprintf(
                '%s (%s)',
                $addressMatch->municipalityName(),
                $addressMatch->municipalityName()->municipalityNameId()
            ),
            sprintf(
                '%s (%s)',
                $addressMatch->streetName(),
                $addressMatch->streetName()->streetNameId()
            ),
            $addressMatch->score(),
        ]
    );
}
$table->render();

printFooter();
