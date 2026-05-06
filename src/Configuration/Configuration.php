<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Configuration;

use DigipolisGent\API\Client\Configuration\Configuration as BaseConfiguration;

/**
 * Configuration with optional user key value.
 */
final class Configuration extends BaseConfiguration implements ConfigurationInterface
{
    /**
     * @inheritDoc
     */
    public function __construct(
        protected string $endpointUri,
        private readonly ?string $userKey = null,
        private readonly ?string $apiKey = null,
        array $options = []
    ) {
        parent::__construct($endpointUri, $options);
    }

    /**
     * {@inheritDoc}
     */
    public function userKey(): ?string
    {
        return $this->userKey;
    }

    /**
     * {@inheritDoc}
     */
    public function apiKey(): ?string
    {
        return $this->apiKey;
    }
}
