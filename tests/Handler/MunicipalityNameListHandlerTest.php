<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Handler;

use DigipolisGent\Flanders\BasicRegisters\Handler\MunicipalityNameListHandler;
use DigipolisGent\Flanders\BasicRegisters\Request\MunicipalityNameListRequest;
use DigipolisGent\Flanders\BasicRegisters\Response\MunicipalityNameListResponse;
use DigipolisGent\Flanders\BasicRegisters\Value\Municipality\MunicipalityNames;
use GuzzleHttp\Psr7\Stream;
use DigipolisGent\Tests\Flanders\BasicRegisters\TestCase;
use Psr\Http\Message\ResponseInterface;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Handler\MunicipalityNameListHandler
 */
class MunicipalityNameListHandlerTest extends TestCase
{
    /**
     * Handler handles AddressListRequest.
     *
     * @test
     */
    public function handlerHandlesMunicipalityNamesRequest(): void
    {
        $handler = new MunicipalityNameListHandler();

        $this->assertEquals(
            [MunicipalityNameListRequest::class],
            $handler->handles()
        );
    }

    /**
     * To response converts the PSR response into a MunicipalityNamesResponse.
     *
     * @test
     */
    public function handlerTransformsResponse(): void
    {
        $stream = $this->prophesize(Stream::class);
        $stream->getContents()->willReturn('{"gemeenten":[], "totaalAantal":0}');
        $response = $this->prophesize(ResponseInterface::class);
        $response->getBody()->willReturn($stream->reveal());

        $expected = new MunicipalityNameListResponse(new MunicipalityNames());

        $handler = new MunicipalityNameListHandler();
        $this->assertEquals($expected, $handler->toResponse($response->reveal()));
    }
}
