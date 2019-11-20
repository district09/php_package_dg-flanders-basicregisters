<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters;

use DigipolisGent\API\Client\ClientInterface;
use DigipolisGent\Flanders\BasicRegisters\BasicRegisters;
use DigipolisGent\Flanders\BasicRegisters\BasicRegistersFactory;
use DigipolisGent\Flanders\BasicRegisters\Handler\AddressDetailHandler;
use DigipolisGent\Flanders\BasicRegisters\Handler\AddressListHandler;
use DigipolisGent\Flanders\BasicRegisters\Handler\AddressMatchHandler;
use DigipolisGent\Flanders\BasicRegisters\Handler\MunicipalityNamesHandler;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\BasicRegistersFactory
 */
class BasicRegistersFactoryTest extends TestCase
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
            ->addHandler(new AddressListHandler())
            ->shouldBeCalled();
        $clientMock
            ->addHandler(new AddressDetailHandler())
            ->shouldBeCalled();
        $client = $clientMock->reveal();
        $clientMock
            ->addHandler(new AddressMatchHandler())
            ->shouldBeCalled();

        $clientMock
            ->addHandler(new MunicipalityNamesHandler())
            ->shouldBeCalled();

        $factory = new BasicRegistersFactory();

        $expected = new BasicRegisters($client);
        $this->assertEquals($expected, $factory->create($client));
    }
}
