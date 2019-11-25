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

// Start output.
echo PHP_EOL;
echo str_repeat('-', 80) . PHP_EOL;
echo 'Get a list of the post info of (sub)municipalities in Gent from the service.' . PHP_EOL;
echo str_repeat('-', 80) . PHP_EOL;
echo PHP_EOL;

echo ' → Create the API client configuration.' . PHP_EOL;
$configuration = new Configuration($apiEndpoint, $apiUserKey);

echo ' → Create the Guzzle client.' . PHP_EOL;
$guzzleClient = new GuzzleHttp\Client(['base_uri' => $configuration->getUri()]);

echo ' → Create the HTTP client.' . PHP_EOL;
$client = new Client($guzzleClient, $configuration);

echo ' → Create the Service wrapper.' . PHP_EOL;
$service = new BasicRegister($client);

echo ' → List of (sub)municipalities of Gent.' . PHP_EOL;
$filters = new Filters(new MunicipalityNameFilter('gent'));
$postInfos = $service->postInfo()->list($filters, new Pager(0, 25));
foreach ($postInfos as $postInfo) {
    /** @var \DigipolisGent\Flanders\BasicRegisters\Value\Post\PostInfoInterface $postInfo */
    echo sprintf('   • %s', $postInfo->postInfoId());
    echo PHP_EOL;

    foreach ($postInfo->geographicalNames() as $geographicalName) {
        /** @var \DigipolisGent\Flanders\BasicRegisters\Value\Geographical\GeographicalName $geographicalName */
        echo sprintf('     %s (%s)', $geographicalName, $geographicalName->languageCode()), PHP_EOL;
    }
}

echo PHP_EOL;

echo ' → List of (sub)municipalities of Oudenaarde.' . PHP_EOL;
$filters = new Filters(new MunicipalityNameFilter('oudenaarde'));
$postInfos = $service->postInfo()->list($filters, new Pager(0, 25));
foreach ($postInfos as $postInfo) {
    /** @var \DigipolisGent\Flanders\BasicRegisters\Value\Post\PostInfoInterface $postInfo */
    echo sprintf('   • %s', $postInfo->postInfoId());
    echo PHP_EOL;

    foreach ($postInfo->geographicalNames() as $geographicalName) {
        /** @var \DigipolisGent\Flanders\BasicRegisters\Value\Geographical\GeographicalName $geographicalName */
        echo sprintf('     %s (%s)', $geographicalName, $geographicalName->languageCode()), PHP_EOL;
    }
}

// End.
echo PHP_EOL;
echo str_repeat('-', 80) . PHP_EOL;
echo PHP_EOL;
