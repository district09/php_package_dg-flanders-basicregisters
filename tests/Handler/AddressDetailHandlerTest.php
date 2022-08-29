<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Handler;

use DigipolisGent\Flanders\BasicRegisters\Handler\AddressDetailHandler;
use DigipolisGent\Flanders\BasicRegisters\Request\AddressDetailRequest;
use DigipolisGent\Flanders\BasicRegisters\Response\AddressDetailResponse;
use DigipolisGent\Flanders\BasicRegisters\Value\Address\Address;
use DigipolisGent\Flanders\BasicRegisters\Value\Address\AddressDetail;
use DigipolisGent\Flanders\BasicRegisters\Value\Address\AddressId;
use DigipolisGent\Flanders\BasicRegisters\Value\Address\FullAddress;
use DigipolisGent\Flanders\BasicRegisters\Value\Geographical\GeographicalName;
use DigipolisGent\Flanders\BasicRegisters\Value\LanguageCode;
use DigipolisGent\Flanders\BasicRegisters\Value\Municipality\Municipality;
use DigipolisGent\Flanders\BasicRegisters\Value\Municipality\MunicipalityName;
use DigipolisGent\Flanders\BasicRegisters\Value\Municipality\MunicipalityNameId;
use DigipolisGent\Flanders\BasicRegisters\Value\Position\Lambert72Point;
use DigipolisGent\Flanders\BasicRegisters\Value\Post\PostInfoId;
use DigipolisGent\Flanders\BasicRegisters\Value\Street\StreetName;
use DigipolisGent\Flanders\BasicRegisters\Value\Street\StreetNameId;
use GuzzleHttp\Psr7\Stream;
use DigipolisGent\Tests\Flanders\BasicRegisters\TestCase;
use Psr\Http\Message\ResponseInterface;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Handler\AddressDetailHandler
 */
class AddressDetailHandlerTest extends TestCase
{
    /**
     * Json data to test with.
     *
     * @var string
     */
    private $json = <<<EOT
{
    "identificator": {
        "id": "https://data.vlaanderen.be/id/adres/2550151",
        "naamruimte": "https://data.vlaanderen.be/id/adres",
        "objectId": "2550151",
        "versieId": 25
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
    "postinfo": {
        "objectId": "9050",
        "detail": "https://basisregisters.vlaanderen.be/api/v1/postinfo/9050"
    },
    "straatnaam": {
        "objectId": "69683",
        "detail": "https://basisregisters.vlaanderen.be/api/v1/straatnamen/69683",
        "straatnaam": {
            "geografischeNaam": {
                "spelling": "Bellevue",
                "taal": "NL"
            }
        }
    },
    "huisnummer": "1",
    "volledigAdres": {
        "geografischeNaam": {
            "spelling": "Bellevue 1, 9050 Gent",
            "taal": "NL"
        }
    },
    "adresPositie": {
        "point": {
            "coordinates": [
                105595.28,
                192122.78
            ],
            "type": "Point"
        }
    },
    "positieGeometrieMethode": "AangeduidDoorBeheerder",
    "positieSpecificatie": "Perceel",
    "adresStatus": "InGebruik",
    "officieelToegekend": true
}
EOT;

    /**
     * Handler handles AddressDetailRequest.
     *
     * @test
     */
    public function handlerHandlesAddressDetailRequest(): void
    {
        $handler = new AddressDetailHandler();

        $this->assertEquals(
            [AddressDetailRequest::class],
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
        $stream->getContents()->willReturn($this->json);
        $response = $this->prophesize(ResponseInterface::class);
        $response->getBody()->willReturn($stream->reveal());

        $expected = new AddressDetailResponse($this->createExpectedAddressDetail());

        $handler = new AddressDetailHandler();
        $this->assertEquals($expected, $handler->toResponse($response->reveal()));
    }

    /**
     * The expected AddressDetail.
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\Address\AddressDetail
     */
    private function createExpectedAddressDetail(): AddressDetail
    {
        return new AddressDetail(
            new Address(
                new AddressId(2550151),
                '1',
                '',
                $expected = new FullAddress(
                    new LanguageCode('NL'),
                    'Bellevue 1, 9050 Gent'
                )
            ),
            new Municipality(
                new PostInfoId(9050),
                new MunicipalityName(
                    new MunicipalityNameId(44021),
                    new GeographicalName(
                        new LanguageCode('NL'),
                        'Gent'
                    )
                )
            ),
            new StreetName(
                new StreetNameId(69683),
                new GeographicalName(
                    new LanguageCode('NL'),
                    'Bellevue'
                )
            ),
            new Lambert72Point(105595.28, 192122.78)
        );
    }
}
