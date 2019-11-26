<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters;

use DigipolisGent\API\Client\ClientInterface;
use DigipolisGent\Flanders\BasicRegisters\BasicRegister;
use DigipolisGent\Flanders\BasicRegisters\Service\AddressService;
use DigipolisGent\Flanders\BasicRegisters\Service\MunicipalityNameService;
use DigipolisGent\Flanders\BasicRegisters\Service\PostInfoService;
use DigipolisGent\Flanders\BasicRegisters\Service\StreetNameService;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\BasicRegister
 */
class BasicRegisterTest extends TestCase
{
    /**
     * Address service is within the container.
     *
     * @test
     */
    public function addressServiceIsInContainer(): void
    {
        $client = $this->prophesize(ClientInterface::class)->reveal();
        $basicRegister = new BasicRegister($client);

        $this->assertInstanceOf(AddressService::class, $basicRegister->address());
    }

    /**
     * MunicipalityName service is within the container.
     *
     * @test
     */
    public function municipalityNameServiceIsInContainer(): void
    {
        $client = $this->prophesize(ClientInterface::class)->reveal();
        $basicRegister = new BasicRegister($client);

        $this->assertInstanceOf(MunicipalityNameService::class, $basicRegister->municipalityName());
    }

    /**
     * StreetName service is within the container.
     *
     * @test
     */
    public function streetNameServiceIsInContainer(): void
    {
        $client = $this->prophesize(ClientInterface::class)->reveal();
        $basicRegister = new BasicRegister($client);

        $this->assertInstanceOf(StreetNameService::class, $basicRegister->streetName());
    }

    /**
     * PostInfo service is within the container.
     *
     * @test
     */
    public function postInfoServiceIsInContainer(): void
    {
        $client = $this->prophesize(ClientInterface::class)->reveal();
        $basicRegister = new BasicRegister($client);

        $this->assertInstanceOf(PostInfoService::class, $basicRegister->postInfo());
    }
}
