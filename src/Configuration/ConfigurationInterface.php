<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Configuration;

use DigipolisGent\API\Client\Configuration\ConfigurationInterface as BaseConfigurationInterface;

/**
 * Configuration with optional user key value.
 */
interface ConfigurationInterface extends BaseConfigurationInterface
{
    /**
     * Get the API user key for the api gateway (if any).
     *
     * @return string|null
     */
    public function userKey(): ?string;

    /**
     * Get the API key for the basic registers Flanders.
     *
     * @see https://basisregisters.vlaanderen.be/apikey
     *
     * @return string|null
     */
    public function apiKey(): ?string;
}
