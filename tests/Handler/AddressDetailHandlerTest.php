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
        "@context": "https://docs.basisregisters.vlaanderen.be/context/adres/2023-02-28/adres_detail.jsonld",
        "@type": "Adres",
        "identificator": {
          "id": "https://data.vlaanderen.be/id/adres/2550151",
          "naamruimte": "https://data.vlaanderen.be/id/adres",
          "objectId": "2550151",
          "versieId": "2023-11-01T14:50:05+01:00"
        },
        "gemeente": {
          "objectId": "44021",
          "detail": "https://api.basisregisters.vlaanderen.be/v2/gemeenten/44021",
          "gemeentenaam": {
            "geografischeNaam": {
              "spelling": "Gent",
              "taal": "nl"
            }
          }
        },
        "postinfo": {
          "objectId": "9050",
          "detail": "https://api.basisregisters.vlaanderen.be/v2/postinfo/9050"
        },
        "straatnaam": {
          "objectId": "69683",
          "detail": "https://api.basisregisters.vlaanderen.be/v2/straatnamen/69683",
          "straatnaam": {
            "geografischeNaam": {
              "spelling": "Bellevue",
              "taal": "nl"
            }
          }
        },
        "huisnummer": "1",
        "volledigAdres": {
          "geografischeNaam": {
            "spelling": "Bellevue 1, 9050 Gent",
            "taal": "nl"
          }
        },
        "adresPositie": {
          "geometrie": {
            "type": "Point",
            "gml": "\u003Cgml:Point srsName=\"https://www.opengis.net/def/crs/EPSG/0/31370\" xmlns:gml=\"http://www.opengis.net/gml/3.2\"\u003E\u003Cgml:pos\u003E105600.61 192113.19\u003C/gml:pos\u003E\u003C/gml:Point\u003E"
          },
          "positieGeometrieMethode": "aangeduidDoorBeheerder",
          "positieSpecificatie": "gebouweenheid"
        },
        "adresStatus": "inGebruik",
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
            new Lambert72Point(105600.61, 192113.19)
        );
    }
}
