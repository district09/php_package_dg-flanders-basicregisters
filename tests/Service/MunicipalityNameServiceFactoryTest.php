<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Service;

use DigipolisGent\API\Client\ClientInterface;
use DigipolisGent\Flanders\BasicRegisters\Service\MunicipalityNameService;
use DigipolisGent\Flanders\BasicRegisters\Handler\MunicipalityNameDetailHandler;
use DigipolisGent\Flanders\BasicRegisters\Handler\MunicipalityNamesHandler;
use DigipolisGent\Flanders\BasicRegisters\Service\MunicipalityNameServiceFactory;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Service\MunicipalityNameServiceFactory
 */
class MunicipalityNameServiceFactoryTest extends TestCase
{
    /**
     * The factored client contains all handlers.
     *
     * @test
     */
    public function factoredClientContainsAllHandlers(): void
    {
        $clientMock = $this->prophesize(ClientInterface::class);
        $clientMock
            ->addHandler(new MunicipalityNamesHandler())
            ->shouldBeCalled();
        $clientMock
            ->addHandler(new MunicipalityNameDetailHandler())
            ->shouldBeCalled();
        $client = $clientMock->reveal();

        $factory = new MunicipalityNameServiceFactory();

        $expected = new MunicipalityNameService($client);
        $this->assertEquals($expected, $factory->create($client));
    }
}
