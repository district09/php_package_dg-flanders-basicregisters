<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Service;

use DigipolisGent\API\Client\ClientInterface;
use DigipolisGent\Flanders\BasicRegisters\Service\AddressService;
use DigipolisGent\Flanders\BasicRegisters\Service\AddressServiceFactory;
use DigipolisGent\Flanders\BasicRegisters\Handler\AddressDetailHandler;
use DigipolisGent\Flanders\BasicRegisters\Handler\AddressListHandler;
use DigipolisGent\Flanders\BasicRegisters\Handler\AddressMatchHandler;
use DigipolisGent\Tests\Flanders\BasicRegisters\TestCase;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Service\AddressServiceFactory
 */
class AddressServiceFactoryTest extends TestCase
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
        $clientMock
            ->addHandler(new AddressMatchHandler())
            ->shouldBeCalled();
        $client = $clientMock->reveal();

        $factory = new AddressServiceFactory();

        $expected = new AddressService($client);
        $this->assertEquals($expected, $factory->create($client));
    }
}
