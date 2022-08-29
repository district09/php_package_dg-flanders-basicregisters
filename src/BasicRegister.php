<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters;

use DigipolisGent\API\Cache\CacheableTrait;
use DigipolisGent\API\Client\ClientInterface;
use DigipolisGent\API\Logger\LoggableTrait;
use DigipolisGent\API\Service\ServiceInterface;
use DigipolisGent\Flanders\BasicRegisters\Service\AddressService;
use DigipolisGent\Flanders\BasicRegisters\Service\AddressServiceInterface;
use DigipolisGent\Flanders\BasicRegisters\Service\MunicipalityNameService;
use DigipolisGent\Flanders\BasicRegisters\Service\MunicipalityNameServiceInterface;
use DigipolisGent\Flanders\BasicRegisters\Service\PostInfoService;
use DigipolisGent\Flanders\BasicRegisters\Service\PostInfoServiceInterface;
use DigipolisGent\Flanders\BasicRegisters\Service\StreetNameService;
use DigipolisGent\Flanders\BasicRegisters\Service\StreetNameServiceInterface;

/**
 * Container of all BasicRegister services.
 */
class BasicRegister implements BasicRegisterInterface
{
    use CacheableTrait;
    use LoggableTrait;

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
        /** @var \DigipolisGent\Flanders\BasicRegisters\Service\AddressServiceInterface $service */
        $service = $this->getService(AddressService::class);
        return $service;
    }

    /**
     * @inheritDoc
     */
    public function municipalityName(): MunicipalityNameServiceInterface
    {
        /** @var \DigipolisGent\Flanders\BasicRegisters\Service\MunicipalityNameServiceInterface $service */
        $service = $this->getService(MunicipalityNameService::class);
        return $service;
    }

    /**
     * @inheritDoc
     */
    public function streetName(): StreetNameServiceInterface
    {
        /** @var \DigipolisGent\Flanders\BasicRegisters\Service\StreetNameServiceInterface $service */
        $service = $this->getService(StreetNameService::class);
        return $service;
    }

    /**
     * @inheritDoc
     */
    public function postInfo(): PostInfoServiceInterface
    {
        /** @var \DigipolisGent\Flanders\BasicRegisters\Service\PostInfoServiceInterface $service */
        $service = $this->getService(PostInfoService::class);
        return $service;
    }

    /**
     * Get a specific service by its class name.
     *
     * @param string $serviceClassName
     *
     * @return \DigipolisGent\API\Service\ServiceInterface
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

        /** @var \DigipolisGent\API\Service\ServiceAbstract $service */
        $service = $factory->create($client);

        /** @var \Psr\SimpleCache\CacheInterface|null $cache */
        $cache = $this->cache;
        if ($cache) {
            $service->setCacheService($cache);
        }
        foreach ($this->loggers as $logger) {
            $service->addLogger($logger);
        }

        $this->services[$serviceClassName] = $service;
    }
}
