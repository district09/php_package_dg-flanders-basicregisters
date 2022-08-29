<?php

/**
 * Example how to get the details of a single street name.
 *
 * @var string $apiEndpoint
 * @var string $apiUserKey
 * @var string $examplePostInfoId
 * @var string $examplePostInfoId
 * @var \Symfony\Component\Console\Output\ConsoleOutput $output
 */

use DigipolisGent\Flanders\BasicRegisters\BasicRegister;
use DigipolisGent\Flanders\BasicRegisters\Client\Client;
use DigipolisGent\Flanders\BasicRegisters\Configuration\Configuration;
use DigipolisGent\Flanders\BasicRegisters\Value\Post\PostInfoId;
use Symfony\Component\Console\Helper\Table;

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

$table = new Table($output);
$table->addRows(
    [
        ['Post info ID', (string) $postInfo->postInfoId()],
        ['Municipality name', (string) $postInfo->name()],
    ]
);

if ($postInfo->postInfoNames()->hasSubMunicipalities()) {
    $title  = 'Sub municipalities';
    foreach ($postInfo->postInfoNames() as $geographicalName) {
        /** @var \DigipolisGent\Flanders\BasicRegisters\Value\Geographical\GeographicalName $geographicalName */
        $table->addRow(
            [
                $title,
                (string) $geographicalName
            ]
        );

        $title = '';
    }
}

$table->render();

printFooter();
