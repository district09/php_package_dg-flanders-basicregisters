<?php

/**
 * Example how to get a list of post info values.
 *
 * @var string $apiEndpoint
 * @var string $apiUserKey
 * @var string $examplePostInfoName
 * @var \Symfony\Component\Console\Output\ConsoleOutput $output
 */

use DigipolisGent\Flanders\BasicRegisters\BasicRegister;
use DigipolisGent\Flanders\BasicRegisters\Client\Client;
use DigipolisGent\Flanders\BasicRegisters\Configuration\Configuration;
use DigipolisGent\Flanders\BasicRegisters\Pager\Pager;
use Symfony\Component\Console\Helper\Table;

require_once __DIR__ . '/bootstrap.php';

printTitle('Get the first 25 post info items from the service.');

printStep('Create the API client configuration.');
$configuration = new Configuration($apiEndpoint, $apiUserKey);

printStep('Create the Guzzle client.');
$guzzleClient = new GuzzleHttp\Client(['base_uri' => $configuration->getUri()]);

printStep('Create the HTTP client.');
$client = new Client($guzzleClient, $configuration);

printStep('Create the Service wrapper.');
$service = new BasicRegister($client);

printStep('List of (sub)municipalities of %s:', $examplePostInfoName);
$postInfos = $service->postInfo()->list(null, new Pager(0, 25));

$table = new Table($output);
$table->setHeaders(['ID', 'Name', 'Sublocality']);

/** @var \DigipolisGent\Flanders\BasicRegisters\Value\Post\PostInfoInterface $postInfo */
foreach ($postInfos as $postInfo) {
    foreach ($postInfo->postInfoNames() as $sublocalityName) {
        $table->addRow(
            [
                (string) $postInfo->postInfoId(),
                $postInfo->name(),
                $postInfo->postInfoNames()->hasSubMunicipalities() ? (string) $sublocalityName : '',
            ]
        );
    }
}
$table->render();

printFooter();
