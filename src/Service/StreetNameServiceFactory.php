<?php

namespace DigipolisGent\Flanders\BasicRegisters\Service;

use DigipolisGent\API\Client\ClientInterface;
use DigipolisGent\Flanders\BasicRegisters\Handler\StreetNameListHandler;
use DigipolisGent\Flanders\BasicRegisters\Handler\StreetNameDetailHandler;

/**
 * Factory to get the StreetName service methods.
 */
final class StreetNameServiceFactory
{
    /**
     * @param \DigipolisGent\API\Client\ClientInterface $client
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Service\StreetNameServiceInterface
     */
    public static function create(ClientInterface $client): StreetNameServiceInterface
    {
        $client->addHandler(new StreetNameListHandler());
        $client->addHandler(new StreetNameDetailHandler());

        return new StreetNameService($client);
    }
}
