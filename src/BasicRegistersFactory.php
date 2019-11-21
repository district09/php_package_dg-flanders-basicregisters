<?php

namespace DigipolisGent\Flanders\BasicRegisters;

use DigipolisGent\API\Client\ClientInterface;
use DigipolisGent\Flanders\BasicRegisters\Handler\AddressDetailHandler;
use DigipolisGent\Flanders\BasicRegisters\Handler\AddressListHandler;
use DigipolisGent\Flanders\BasicRegisters\Handler\AddressMatchHandler;
use DigipolisGent\Flanders\BasicRegisters\Handler\MunicipalityNameDetailHandler;
use DigipolisGent\Flanders\BasicRegisters\Handler\MunicipalityNamesHandler;

/**
 * Factory to get the BasicRegisters.
 */
final class BasicRegistersFactory
{
    /**
     * @param \DigipolisGent\API\Client\ClientInterface $client
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\BasicRegistersInterface
     */
    public static function create(ClientInterface $client): BasicRegistersInterface
    {
        $client->addHandler(new AddressListHandler());
        $client->addHandler(new AddressDetailHandler());
        $client->addHandler(new AddressMatchHandler());

        $client->addHandler(new MunicipalityNamesHandler());
        $client->addHandler(new MunicipalityNameDetailHandler());

        return new BasicRegisters($client);
    }
}
