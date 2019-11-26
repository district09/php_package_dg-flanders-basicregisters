<?php

namespace DigipolisGent\Flanders\BasicRegisters\Service;

use DigipolisGent\API\Client\ClientInterface;
use DigipolisGent\Flanders\BasicRegisters\Handler\AddressDetailHandler;
use DigipolisGent\Flanders\BasicRegisters\Handler\AddressListHandler;
use DigipolisGent\Flanders\BasicRegisters\Handler\AddressMatchHandler;

/**
 * Factory to get the Address service methods.
 */
final class AddressServiceFactory
{
    /**
     * @param \DigipolisGent\API\Client\ClientInterface $client
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Service\AddressServiceInterface
     */
    public static function create(ClientInterface $client): AddressServiceInterface
    {
        $client->addHandler(new AddressListHandler());
        $client->addHandler(new AddressDetailHandler());
        $client->addHandler(new AddressMatchHandler());

        return new AddressService($client);
    }
}
