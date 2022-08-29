<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Configuration;

use DigipolisGent\Flanders\BasicRegisters\Configuration\Configuration;
use DigipolisGent\Tests\Flanders\BasicRegisters\TestCase;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Configuration\Configuration
 */
class ConfigurationTest extends TestCase
{
    /**
     * Configuration can be created with user key.
     *
     * @test
     */
    public function configurationCanBeCreatedFromDetails(): void
    {
        $configuration = new Configuration('https://endpoint', 'api-user-key');

        $this->assertEquals('https://endpoint', $configuration->getUri());
        $this->assertEquals('api-user-key', $configuration->userKey());
    }
}
