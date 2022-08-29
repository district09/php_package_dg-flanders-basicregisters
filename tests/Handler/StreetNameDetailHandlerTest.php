<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Handler;

use DigipolisGent\Flanders\BasicRegisters\Handler\StreetNameDetailHandler;
use DigipolisGent\Flanders\BasicRegisters\Request\StreetNameDetailRequest;
use DigipolisGent\Flanders\BasicRegisters\Response\StreetNameDetailResponse;
use DigipolisGent\Flanders\BasicRegisters\Value\Geographical\GeographicalName;
use DigipolisGent\Flanders\BasicRegisters\Value\Geographical\GeographicalNames;
use DigipolisGent\Flanders\BasicRegisters\Value\LanguageCode;
use DigipolisGent\Flanders\BasicRegisters\Value\Municipality\MunicipalityName;
use DigipolisGent\Flanders\BasicRegisters\Value\Municipality\MunicipalityNameId;
use DigipolisGent\Flanders\BasicRegisters\Value\Street\StreetNameDetail;
use DigipolisGent\Flanders\BasicRegisters\Value\Street\StreetNameId;
use GuzzleHttp\Psr7\Stream;
use DigipolisGent\Tests\Flanders\BasicRegisters\TestCase;
use Psr\Http\Message\ResponseInterface;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Handler\StreetNameDetailHandler
 */
class StreetNameDetailHandlerTest extends TestCase
{
    /**
     * Json data to test with.
     *
     * @var string
     */
    private $json = <<<EOT
{
    "identificator": {
        "id": "https://data.vlaanderen.be/id/straatnaam/69683",
        "naamruimte": "https://data.vlaanderen.be/id/straatnaam",
        "objectId": "69683",
        "versieId": 6
    },
    "gemeente": {
        "objectId": "44021",
        "detail": "https://basisregisters.vlaanderen.be/api/v1/gemeenten/44021",
        "gemeentenaam": {
            "geografischeNaam": {
                "spelling": "Gent",
                "taal": "NL"
            }
        }
    },
    "straatnamen": [
        {
            "spelling": "Bellevue",
            "taal": "NL"
        }
    ],
    "homoniemToevoegingen": [],
    "straatnaamStatus": "InGebruik"
}
EOT;

    /**
     * Handler handles StreetNameDetail request.
     *
     * @test
     */
    public function handlerHandlesStreetNameDetailRequest(): void
    {
        $handler = new StreetNameDetailHandler();

        $this->assertEquals(
            [StreetNameDetailRequest::class],
            $handler->handles()
        );
    }

    /**
     * To response converts the PSR response into an StreetNameDetailResponse.
     *
     * @test
     */
    public function handlerTransformsResponse(): void
    {
        $stream = $this->prophesize(Stream::class);
        $stream->getContents()->willReturn($this->json);
        $response = $this->prophesize(ResponseInterface::class);
        $response->getBody()->willReturn($stream->reveal());

        $expected = new StreetNameDetailResponse($this->createExpectedStreetNameDetail());

        $handler = new StreetNameDetailHandler();
        $this->assertEquals($expected, $handler->toResponse($response->reveal()));
    }

    /**
     * The expected StreetNameDetail.
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\Street\StreetNameDetail
     */
    private function createExpectedStreetNameDetail(): StreetNameDetail
    {
        return new StreetNameDetail(
            new StreetNameId(69683),
            new GeographicalNames(
                new GeographicalName(
                    new LanguageCode('NL'),
                    'Bellevue'
                )
            ),
            new MunicipalityName(
                new MunicipalityNameId(44021),
                new GeographicalName(
                    new LanguageCode('NL'),
                    'Gent'
                )
            )
        );
    }
}
