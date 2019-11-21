<?php

namespace DigipolisGent\Flanders\BasicRegisters\Service;

use DigipolisGent\API\Client\ClientInterface;
use DigipolisGent\Flanders\BasicRegisters\Handler\MunicipalityNameDetailHandler;
use DigipolisGent\Flanders\BasicRegisters\Handler\MunicipalityNamesHandler;

/**
 * Factory to get the MunicipalityName service methods.
 */
final class MunicipalityNameServiceFactory
{
    /**
     * @param \DigipolisGent\API\Client\ClientInterface $client
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\MunicipalityNameInterface
     */
    public static function create(ClientInterface $client): MunicipalityNameServiceInterface
    {
        $client->addHandler(new MunicipalityNamesHandler());
        $client->addHandler(new MunicipalityNameDetailHandler());

        return new MunicipalityNameService($client);
    }
}
