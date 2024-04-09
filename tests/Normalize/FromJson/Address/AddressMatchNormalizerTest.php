<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Normalize\FromJson\Address;

use DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\Address\AddressMatchNormalizer;
use DigipolisGent\Flanders\BasicRegisters\Value\Address\Address;
use DigipolisGent\Flanders\BasicRegisters\Value\Address\AddressDetail;
use DigipolisGent\Flanders\BasicRegisters\Value\Address\AddressId;
use DigipolisGent\Flanders\BasicRegisters\Value\Address\AddressMatch;
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
use DigipolisGent\Tests\Flanders\BasicRegisters\TestCase;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\Address\AddressMatchNormalizer
 */
class AddressMatchNormalizerTest extends TestCase
{
    /**
     * Json data without address details to test with.
     *
     * @var string
     */
    private $jsonDataWithoutAddressDetails = <<<EOT
    {
        "@type": "Adres",
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
        "score": 100,
        "links": []
      }
EOT;


    /**
     * Json data containing the address details to test with.
     *
     * @var string
     */
    private $jsonWithAddressDetails = <<<EOT
    {
        "@type": "Adres",
        "identificator": {
          "id": "https://data.vlaanderen.be/id/adres/2550151",
          "naamruimte": "https://data.vlaanderen.be/id/adres",
          "objectId": "2550151",
          "versieId": "2023-11-01T14:50:05+01:00"
        },
        "detail": "https://api.basisregisters.vlaanderen.be/v2/adressen/2550151",
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
        "officieelToegekend": true,
        "score": 98.4848484848485,
        "links": [
          {
            "href": "https://api.basisregisters.vlaanderen.be/v2/percelen?adresobjectid=2550151",
            "rel": "percelen",
            "type": "GET"
          },
          {
            "href": "https://api.basisregisters.vlaanderen.be/v2/gebouweenheden?adresobjectid=2550151",
            "rel": "gebouweenheden",
            "type": "GET"
          }
        ]
      }
EOT;

    /**
     * Json without address detail is normalized into an AddressMatch value.
     *
     * @test
     */
    public function jsonWithoutAddressDetailIsNormalized(): void
    {
        $expected = new AddressMatch(
            new MunicipalityName(
                new MunicipalityNameId(44021),
                new GeographicalName(
                    new LanguageCode('NL'),
                    'Gent'
                )
            ),
            new StreetName(
                new StreetNameId(69683),
                new GeographicalName(
                    new LanguageCode('NL'),
                    'Bellevue'
                )
            ),
            null,
            100
        );

        $normalizer = new AddressMatchNormalizer();
        $jsonData = json_decode($this->jsonDataWithoutAddressDetails);

        $this->assertEquals(
            $expected,
            $normalizer->normalize($jsonData)
        );
    }

    /**
     * Json with address detail is normalized into an AddressMatch value.
     *
     * @test
     */
    public function jsonDataWithAddressDetailIsNormalized(): void
    {
        $expected = new AddressMatch(
            new MunicipalityName(
                new MunicipalityNameId(44021),
                new GeographicalName(
                    new LanguageCode('NL'),
                    'Gent'
                )
            ),
            new StreetName(
                new StreetNameId(69683),
                new GeographicalName(
                    new LanguageCode('NL'),
                    'Bellevue'
                )
            ),
            new AddressDetail(
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
            ),
            98.4848484848485
        );

        $normalizer = new AddressMatchNormalizer();
        $jsonData = json_decode($this->jsonWithAddressDetails);

        $this->assertEquals(
            $expected,
            $normalizer->normalize($jsonData)
        );
    }
}
