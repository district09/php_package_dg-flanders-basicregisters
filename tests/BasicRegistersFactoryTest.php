<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters;

use DigipolisGent\API\Client\ClientInterface;
use DigipolisGent\Flanders\BasicRegisters\BasicRegisters;
use DigipolisGent\Flanders\BasicRegisters\BasicRegistersFactory;
use DigipolisGent\Flanders\BasicRegisters\Handler\AddressListHandler;
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
        $client = $clientMock->reveal();

        $factory = new BasicRegistersFactory();

        $expected = new BasicRegisters($client);
        $this->assertEquals($expected, $factory->create($client));
    }
}
