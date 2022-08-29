<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Handler;

use DigipolisGent\Flanders\BasicRegisters\Handler\AddressMatchHandler;
use DigipolisGent\Flanders\BasicRegisters\Request\AddressMatchRequest;
use DigipolisGent\Flanders\BasicRegisters\Response\AddressMatchResponse;
use DigipolisGent\Flanders\BasicRegisters\Value\Address\AddressMatches;
use GuzzleHttp\Psr7\Stream;
use DigipolisGent\Tests\Flanders\BasicRegisters\TestCase;
use Psr\Http\Message\ResponseInterface;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Handler\AddressMatchHandler
 */
class AddressMatchHandlerTest extends TestCase
{
    /**
     * Handler handles AddressListRequest.
     *
     * @test
     */
    public function handlerHandlesAddressListRequest(): void
    {
        $handler = new AddressMatchHandler();

        $this->assertEquals(
            [AddressMatchRequest::class],
            $handler->handles()
        );
    }

    /**
     * To response converts the PSR response into an AddressMatchResponse.
     *
     * @test
     */
    public function handlerTransformsResponse(): void
    {
        $stream = $this->prophesize(Stream::class);
        $stream->getContents()->willReturn('{"adresMatches":[], "warnings":[]}');
        $response = $this->prophesize(ResponseInterface::class);
        $response->getBody()->willReturn($stream->reveal());

        $expected = new AddressMatchResponse(new AddressMatches());

        $handler = new AddressMatchHandler();
        $this->assertEquals($expected, $handler->toResponse($response->reveal()));
    }
}
