<?php

/**
 * Example how to get the details of a single street name.
 */

use DigipolisGent\Flanders\BasicRegisters\BasicRegister;
use DigipolisGent\Flanders\BasicRegisters\Client\Client;
use DigipolisGent\Flanders\BasicRegisters\Configuration\Configuration;
use DigipolisGent\Flanders\BasicRegisters\Value\Post\PostInfoId;

require_once __DIR__ . '/bootstrap.php';

printTitle('Get the details of a single post info from the service.');

printStep('Create the API client configuration.');
$configuration = new Configuration($apiEndpoint, $apiUserKey);

printStep('Create the Guzzle client.');
$guzzleClient = new GuzzleHttp\Client(['base_uri' => $configuration->getUri()]);

printStep('Create the HTTP client.');
$client = new Client($guzzleClient, $configuration);

printStep('Create the Service wrapper.');
$service = new BasicRegister($client);

printStep('Post info details of post info id %d:', $examplePostInfoId);
$postInfoId = new PostInfoId($examplePostInfoId);
$postInfo = $service->postInfo()->detail($postInfoId);

/** @var \DigipolisGent\Flanders\BasicRegisters\Value\Post\PostInfoInterface $postInfo */
printBullet('%s', $postInfo);

if ($postInfo->postInfoNames()->hasSubMunicipalities()) {
    foreach ($postInfo->postInfoNames() as $geographicalName) {
        /** @var \DigipolisGent\Flanders\BasicRegisters\Value\Geographical\GeographicalName $geographicalName */
        printText('    - %s', $geographicalName);
    }
}

printFooter();
