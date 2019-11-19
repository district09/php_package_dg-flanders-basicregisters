<?php

namespace DigipolisGent\Flanders\BasicRegisters;

use DigipolisGent\API\Client\ClientInterface;
use DigipolisGent\Flanders\BasicRegisters\Handler\AddressListHandler;

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

        return new BasicRegisters($client);
    }
}
