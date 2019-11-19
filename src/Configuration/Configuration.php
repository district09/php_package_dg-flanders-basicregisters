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
     * The API user key.
     *
     * @var string|null
     */
    private $userKey;

    /**
     * @inheritDoc
     */
    public function __construct(string $endpointUri, ?string $userKey, array $options = [])
    {
        parent::__construct($endpointUri, $options);

        $this->userKey = $userKey;
    }

    /**
     * @inheritDoc
     */
    public function userKey(): ?string
    {
        return $this->userKey;
    }
}
