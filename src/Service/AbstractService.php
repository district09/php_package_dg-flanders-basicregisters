<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Service;

use DigipolisGent\API\Client\ClientInterface;

/**
 * Abstract service implementation.
 */
abstract class AbstractService implements ServiceInterface
{
    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * Create a new lodging service by injecting the client.
     *
     * @param \DigipolisGent\API\Client\ClientInterface $client
     */
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * Get the client.
     *
     * @return \DigipolisGent\API\Client\ClientInterface
     */
    protected function client(): ClientInterface
    {
        return $this->client;
    }
}
