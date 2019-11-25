<?php

/**
 * Example how to get a list of post info values.
 */

use DigipolisGent\Flanders\BasicRegisters\BasicRegister;
use DigipolisGent\Flanders\BasicRegisters\Client\Client;
use DigipolisGent\Flanders\BasicRegisters\Configuration\Configuration;
use DigipolisGent\Flanders\BasicRegisters\Filter\Filters;
use DigipolisGent\Flanders\BasicRegisters\Filter\MunicipalityNameFilter;
use DigipolisGent\Flanders\BasicRegisters\Pager\Pager;

require_once __DIR__ . '/bootstrap.php';

printTitle('Get a list of the post info of (sub)municipalities from the service.');

printStep('Create the API client configuration.');
$configuration = new Configuration($apiEndpoint, $apiUserKey);

printStep('Create the Guzzle client.');
$guzzleClient = new GuzzleHttp\Client(['base_uri' => $configuration->getUri()]);

printStep('Create the HTTP client.');
$client = new Client($guzzleClient, $configuration);

printStep('Create the Service wrapper.');
$service = new BasicRegister($client);

printStep('List of (sub)municipalities of %s:', $examplePostInfoName);
$filters = new Filters(new MunicipalityNameFilter($examplePostInfoName));
$postInfos = $service->postInfo()->list($filters, new Pager(0, 25));

foreach ($postInfos as $postInfo) {
    /** @var \DigipolisGent\Flanders\BasicRegisters\Value\Post\PostInfoInterface $postInfo */
    printBullet('%s', $postInfo);

    if ($postInfo->postInfoNames()->hasSubMunicipalities()) {
        foreach ($postInfo->postInfoNames() as $geographicalName) {
            /** @var \DigipolisGent\Flanders\BasicRegisters\Value\Geographical\GeographicalName $geographicalName */
            printText('    - %s', $geographicalName);
        }
    }
}

printFooter();
