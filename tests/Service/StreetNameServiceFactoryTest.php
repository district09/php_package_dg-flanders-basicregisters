<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Service;

use DigipolisGent\API\Client\ClientInterface;
use DigipolisGent\Flanders\BasicRegisters\Handler\StreetNameDetailHandler;
use DigipolisGent\Flanders\BasicRegisters\Handler\StreetNameListHandler;
use DigipolisGent\Flanders\BasicRegisters\Service\StreetNameService;
use DigipolisGent\Flanders\BasicRegisters\Service\StreetNameServiceFactory;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Service\StreetNameServiceFactory
 */
class StreetNameServiceFactoryTest extends TestCase
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
            ->addHandler(new StreetNameListHandler())
            ->shouldBeCalled();
        $clientMock
            ->addHandler(new StreetNameDetailHandler())
            ->shouldBeCalled();
        $client = $clientMock->reveal();

        $factory = new StreetNameServiceFactory();

        $expected = new StreetNameService($client);
        $this->assertEquals($expected, $factory->create($client));
    }
}
