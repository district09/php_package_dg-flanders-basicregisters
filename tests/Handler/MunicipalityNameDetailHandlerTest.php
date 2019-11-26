<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Handler;

use DigipolisGent\Flanders\BasicRegisters\Handler\MunicipalityNameDetailHandler;
use DigipolisGent\Flanders\BasicRegisters\Request\MunicipalityNameDetailRequest;
use DigipolisGent\Flanders\BasicRegisters\Response\MunicipalityNameDetailResponse;
use DigipolisGent\Flanders\BasicRegisters\Value\Geographical\GeographicalName;
use DigipolisGent\Flanders\BasicRegisters\Value\Geographical\GeographicalNames;
use DigipolisGent\Flanders\BasicRegisters\Value\LanguageCode;
use DigipolisGent\Flanders\BasicRegisters\Value\Municipality\MunicipalityNameDetail;
use DigipolisGent\Flanders\BasicRegisters\Value\Municipality\MunicipalityNameDetailInterface;
use DigipolisGent\Flanders\BasicRegisters\Value\Municipality\MunicipalityNameId;
use GuzzleHttp\Psr7\Stream;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Handler\MunicipalityNameDetailHandler
 */
class MunicipalityNameDetailHandlerTest extends TestCase
{
    /**
     * Json data to test with.
     *
     * @var string
     */
    private $json = <<<EOT
{
    "identificator": {
        "id": "https://data.vlaanderen.be/id/gemeente/44021",
        "naamruimte": "https://data.vlaanderen.be/id/gemeente",
        "objectId": "44021",
        "versieId": 4
    },
    "gemeentenamen": [
        {
            "spelling": "Gent",
            "taal": "DE"
        },
        {
            "spelling": "Gand",
            "taal": "FR"
        },
        {
            "spelling": "Gent",
            "taal": "NL"
        }
    ],
    "gemeenteStatus": "InGebruik"
}
EOT;

    /**
     * Handler handles MunicipalityNameRequest.
     *
     * @test
     */
    public function handlesMunicipalityNameRequest(): void
    {
        $handler = new MunicipalityNameDetailHandler();

        $this->assertEquals(
            [MunicipalityNameDetailRequest::class],
            $handler->handles()
        );
    }

    /**
     * To response converts the PSR response into a MunicipalityName.
     *
     * @test
     */
    public function handlerTransformsResponse(): void
    {
        $stream = $this->prophesize(Stream::class);
        $stream->getContents()->willReturn($this->json);
        $response = $this->prophesize(ResponseInterface::class);
        $response->getBody()->willReturn($stream->reveal());

        $expected = new MunicipalityNameDetailResponse($this->createExpectedMunicipalityNameDetail());

        $handler = new MunicipalityNameDetailHandler();
        $this->assertEquals($expected, $handler->toResponse($response->reveal()));
    }

    /**
     * The expected MunicipalityNameDetail.
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\Municipality\MunicipalityNameDetailInterface
     */
    private function createExpectedMunicipalityNameDetail(): MunicipalityNameDetailInterface
    {
        return new MunicipalityNameDetail(
            new MunicipalityNameId(44021),
            new GeographicalNames(
                new GeographicalName(
                    new LanguageCode('DE'),
                    'Gent'
                ),
                new GeographicalName(
                    new LanguageCode('FR'),
                    'Gand'
                ),
                new GeographicalName(
                    new LanguageCode('NL'),
                    'Gent'
                )
            )
        );
    }
}
