<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters;

use DigipolisGent\API\Client\ClientInterface;
use DigipolisGent\Flanders\BasicRegisters\Service\AddressService;
use DigipolisGent\Flanders\BasicRegisters\Service\AddressServiceInterface;
use DigipolisGent\Flanders\BasicRegisters\Service\MunicipalityNameService;
use DigipolisGent\Flanders\BasicRegisters\Service\MunicipalityNameServiceInterface;
use DigipolisGent\Flanders\BasicRegisters\Service\PostInfoService;
use DigipolisGent\Flanders\BasicRegisters\Service\PostInfoServiceInterface;
use DigipolisGent\Flanders\BasicRegisters\Service\ServiceInterface;
use DigipolisGent\Flanders\BasicRegisters\Service\StreetNameService;
use DigipolisGent\Flanders\BasicRegisters\Service\StreetNameServiceInterface;

/**
 * Container of all BasicRegister services.
 */
class BasicRegister implements BasicRegisterInterface
{
    /**
     * The client.
     *
     * @var \DigipolisGent\API\Client\ClientInterface
     */
    private $client;

    /**
     * The services.
     *
     * @var array
     */
    private $services = [
        AddressService::class => null,
        MunicipalityNameService::class => null,
        StreetNameService::class => null,
        PostInfoService::class => null,
    ];

    /**
     * Create the services container.
     *
     * @param \DigipolisGent\API\Client\ClientInterface $client
     */
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @inheritDoc
     */
    public function address(): AddressServiceInterface
    {
        return $this->getService(AddressService::class);
    }

    /**
     * @inheritDoc
     */
    public function municipalityName(): MunicipalityNameServiceInterface
    {
        return $this->getService(MunicipalityNameService::class);
    }

    /**
     * @inheritDoc
     */
    public function streetName(): StreetNameServiceInterface
    {
        return $this->getService(StreetNameService::class);
    }

    /**
     * @inheritDoc
     */
    public function postInfo(): PostInfoServiceInterface
    {
        return $this->getService(PostInfoService::class);
    }

    /**
     * Get a specific service by its class name.
     *
     * @param string $serviceClassName
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Service\ServiceInterface
     */
    private function getService(string $serviceClassName): ServiceInterface
    {
        if (!$this->services[$serviceClassName]) {
            $this->loadService($serviceClassName);
        }

        return $this->services[$serviceClassName];
    }

    /**
     * Load a service into the container.
     *
     * @param string $serviceClassName
     */
    private function loadService(string $serviceClassName): void
    {
        $factoryClass = sprintf('%sFactory', $serviceClassName);
        $factory = new $factoryClass();
        $client = clone($this->client);

        $this->services[$serviceClassName] = $factory->create($client);
    }
}
