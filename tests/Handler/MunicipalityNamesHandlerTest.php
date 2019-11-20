<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Handler;

use DigipolisGent\Flanders\BasicRegisters\Handler\MunicipalityNamesHandler;
use DigipolisGent\Flanders\BasicRegisters\Request\MunicipalityNamesRequest;
use DigipolisGent\Flanders\BasicRegisters\Response\MunicipalityNamesResponse;
use DigipolisGent\Flanders\BasicRegisters\Value\Municipality\MunicipalityNames;
use GuzzleHttp\Psr7\Stream;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Handler\MunicipalityNamesHandler
 */
class MunicipalityNamesHandlerTest extends TestCase
{
    /**
     * Handler handles AddressListRequest.
     *
     * @test
     */
    public function handlerHandlesMunicipalityNamesRequest(): void
    {
        $handler = new MunicipalityNamesHandler();

        $this->assertEquals(
            [MunicipalityNamesRequest::class],
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

        $expected = new MunicipalityNamesResponse(new MunicipalityNames());

        $handler = new MunicipalityNamesHandler();
        $this->assertEquals($expected, $handler->toResponse($response->reveal()));
    }
}
