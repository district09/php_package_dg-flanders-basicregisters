<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Handler;

use DigipolisGent\Flanders\BasicRegisters\Handler\AddressListHandler;
use DigipolisGent\Flanders\BasicRegisters\Request\AddressListRequest;
use DigipolisGent\Flanders\BasicRegisters\Response\AddressListResponse;
use DigipolisGent\Flanders\BasicRegisters\Value\Address\Addresses;
use GuzzleHttp\Psr7\Stream;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Handler\AddressListHandler
 */
class AddressListHandlerTest extends TestCase
{
    /**
     * Handler handles AddressListRequest.
     *
     * @test
     */
    public function handlerHandlesAddressListRequest(): void
    {
        $handler = new AddressListHandler();

        $this->assertEquals(
            [AddressListRequest::class],
            $handler->handles()
        );
    }

    /**
     * To response converts the PSR response into an AddressListResponse.
     *
     * @test
     */
    public function handlerTransformsResponse(): void
    {
        $stream = $this->prophesize(Stream::class);
        $stream->getContents()->willReturn('{"adressen":[], "totaalAantal":0}');
        $response = $this->prophesize(ResponseInterface::class);
        $response->getBody()->willReturn($stream->reveal());

        $expected = new AddressListResponse(new Addresses());

        $handler = new AddressListHandler();
        $this->assertEquals($expected, $handler->toResponse($response->reveal()));
    }
}
