<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Handler;

use DigipolisGent\Flanders\BasicRegisters\Handler\StreetNameListHandler;
use DigipolisGent\Flanders\BasicRegisters\Request\StreetNameListRequest;
use DigipolisGent\Flanders\BasicRegisters\Response\StreetNameListResponse;
use DigipolisGent\Flanders\BasicRegisters\Value\Street\StreetNames;
use GuzzleHttp\Psr7\Stream;
use DigipolisGent\Tests\Flanders\BasicRegisters\TestCase;
use Psr\Http\Message\ResponseInterface;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Handler\StreetNameListHandler
 */
class StreetNameListHandlerTest extends TestCase
{
    /**
     * Handler handles StreetNameListRequest.
     *
     * @test
     */
    public function handlerHandlesStreetNameListRequest(): void
    {
        $handler = new StreetNameListHandler();

        $this->assertEquals(
            [StreetNameListRequest::class],
            $handler->handles()
        );
    }

    /**
     * To response converts the PSR response into an StreetNameListResponse.
     *
     * @test
     */
    public function handlerTransformsResponse(): void
    {
        $stream = $this->prophesize(Stream::class);
        $stream->getContents()->willReturn('{"straatnamen":[], "totaalAantal":0}');
        $response = $this->prophesize(ResponseInterface::class);
        $response->getBody()->willReturn($stream->reveal());

        $expected = new StreetNameListResponse(new StreetNames());

        $handler = new StreetNameListHandler();
        $this->assertEquals($expected, $handler->toResponse($response->reveal()));
    }
}
