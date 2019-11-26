<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Service;

use DigipolisGent\API\Client\ClientInterface;

/**
 * All services need to be created from a client.
 */
interface ServiceInterface
{
    /**
     * Create a new service from a given client.
     *
     * @param \DigipolisGent\API\Client\ClientInterface
     */
    public function __construct(ClientInterface $client);
}
