<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Client;

use DigipolisGent\API\Client\Handler\HandlerInterface;
use DigipolisGent\API\Client\Response\ResponseInterface;
use DigipolisGent\Flanders\BasicRegisters\Client\Client;
use DigipolisGent\Flanders\BasicRegisters\Configuration\ConfigurationInterface;
use GuzzleHttp\Client as GuzzleClient;
use DigipolisGent\Tests\Flanders\BasicRegisters\TestCase;
use Prophecy\Argument;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface as PsrResponse;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Client\Client
 */
class ClientTest extends TestCase
{
    /**
     * No API user key is added to the header if no value within configuration.
     *
     * @test
     */
    public function noApiUserKeyAddedIfNoValueInConfiguration(): void
    {
        $key = '';

        $configuration = $this->prophesize(ConfigurationInterface::class);
        $configuration->userKey()->willReturn($key);

        $finalRequestMock = $this->prophesize(RequestInterface::class);
        $finalRequestMock
            ->withHeader('user-key', $key)
            ->shouldNotBeCalled();
        $finalRequest = $finalRequestMock->reveal();

        $initialRequestMock = $this->prophesize(RequestInterface::class);
        $initialRequestMock
            ->getBody()
            ->willReturn('123');
        $initialRequestMock
            ->withHeader(Argument::any(), Argument::any())
            ->willReturn($finalRequest);
        $initialRequest = $initialRequestMock->reveal();

        $guzzleResponse = $this->prophesize(PsrResponse::class)->reveal();

        $response = $this->prophesize(ResponseInterface::class)->reveal();

        $guzzleClient = $this->prophesize(GuzzleClient::class);
        $guzzleClient
            ->send($finalRequest)
            ->willReturn($guzzleResponse);

        $handler = $this->prophesize(HandlerInterface::class);
        $handler->handles()->willReturn([get_class($initialRequest)]);
        $handler->toResponse($guzzleResponse)->willReturn($response);

        $client = new Client($guzzleClient->reveal(), $configuration->reveal());
        $client->addHandler($handler->reveal());
        $client->send($initialRequest);
    }

    /**
     * API Key is send as header.
     *
     * @test
     */
    public function apiUserKeyIsSendAsHeader()
    {
        $key = 'fiz-baz-key';

        $configuration = $this->prophesize(ConfigurationInterface::class);
        $configuration->userKey()->willReturn($key);

        $finalRequest = $this->prophesize(RequestInterface::class)->reveal();

        $requestWithContentLengthMock = $this->prophesize(RequestInterface::class);
        $requestWithContentLengthMock
            ->withHeader('user-key', $key)
            ->willReturn($finalRequest)
            ->shouldBeCalled();
        $requestWithContentLength = $requestWithContentLengthMock->reveal();

        $initialRequestMock = $this->prophesize(RequestInterface::class);
        $initialRequestMock
            ->getBody()
            ->willReturn('123');
        $initialRequestMock
            ->withHeader(Argument::any(), Argument::any())
            ->willReturn($requestWithContentLength);
        $initialRequest = $initialRequestMock->reveal();

        $guzzleResponse = $this->prophesize(PsrResponse::class)->reveal();

        $response = $this->prophesize(ResponseInterface::class)->reveal();

        $guzzleClient = $this->prophesize(GuzzleClient::class);
        $guzzleClient
            ->send($finalRequest)
            ->willReturn($guzzleResponse);

        $handler = $this->prophesize(HandlerInterface::class);
        $handler->handles()->willReturn([get_class($initialRequest)]);
        $handler->toResponse($guzzleResponse)->willReturn($response);

        $client = new Client($guzzleClient->reveal(), $configuration->reveal());
        $client->addHandler($handler->reveal());
        $client->send($initialRequest);
    }
}
