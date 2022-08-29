<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Service;

use DigipolisGent\API\Client\ClientInterface;
use DigipolisGent\Flanders\BasicRegisters\Handler\PostInfoDetailHandler;
use DigipolisGent\Flanders\BasicRegisters\Handler\PostInfoListHandler;
use DigipolisGent\Flanders\BasicRegisters\Service\PostInfoService;
use DigipolisGent\Flanders\BasicRegisters\Service\PostInfoServiceFactory;
use DigipolisGent\Tests\Flanders\BasicRegisters\TestCase;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Service\PostInfoServiceFactory
 */
class PostInfoServiceFactoryTest extends TestCase
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
            ->addHandler(new PostInfoListHandler())
            ->shouldBeCalled();
        $clientMock
            ->addHandler(new PostInfoDetailHandler())
            ->shouldBeCalled();
        $client = $clientMock->reveal();

        $factory = new PostInfoServiceFactory();

        $expected = new PostInfoService($client);
        $this->assertEquals($expected, $factory->create($client));
    }
}
