<?php

/**
 * Example how to use the AddressMatch service method.
 */

use DigipolisGent\Flanders\BasicRegisters\BasicRegister;
use DigipolisGent\Flanders\BasicRegisters\Client\Client;
use DigipolisGent\Flanders\BasicRegisters\Configuration\Configuration;
use DigipolisGent\Flanders\BasicRegisters\Filter\Filters;
use DigipolisGent\Flanders\BasicRegisters\Filter\HouseNumberFilter;
use DigipolisGent\Flanders\BasicRegisters\Filter\MunicipalityNameFilter;
use DigipolisGent\Flanders\BasicRegisters\Filter\PostalCodeFilter;
use DigipolisGent\Flanders\BasicRegisters\Filter\StreetNameFilter;

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
    new StreetNameFilter('bellevue'),
    new HouseNumberFilter(5)
);

printStep('List of address that match the search.');
$addressMatches = $service->address()->match($filters);

foreach ($addressMatches as $addressMatch) {
    /** @var \DigipolisGent\Flanders\BasicRegisters\Value\Address\AddressMatch $addressMatch */
    printBullet('%s', (string) $addressMatch);
    printText('    Municipality name ID : %s', $addressMatch->municipalityName()->municipalityNameId());
    printText('    Municipality name    : %s', $addressMatch->municipalityName());
    printText('    Street name ID       : %s', $addressMatch->streetName()->streetNameId());
    printText('    Street name          : %s', $addressMatch->streetName());
    printText('    Address ID           : %s', $addressMatch->addressDetail() ?? 'NA');
    printText('    Match Score          : %s', $addressMatch->score());
}

printFooter();
