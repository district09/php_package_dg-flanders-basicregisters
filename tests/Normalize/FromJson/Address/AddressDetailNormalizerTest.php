<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Normalize\FromJson\Address;

use DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\Address\AddressDetailNormalizer;
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
use DigipolisGent\Tests\Flanders\BasicRegisters\TestCase;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\Address\AddressDetailNormalizer
 */
class AddressDetailNormalizerTest extends TestCase
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
        "geometrie": {
          "type": "Point",
          "gml": "\u003Cgml:Point srsName=\"https://www.opengis.net/def/crs/EPSG/0/31370\" xmlns:gml=\"http://www.opengis.net/gml/3.2\"\u003E\u003Cgml:pos\u003E105600.61 19113.19\u003C/gml:pos\u003E\u003C/gml:Point\u003E"
        },
        "positieGeometrieMethode": "aangeduidDoorBeheerder",
        "positieSpecificatie": "gebouweenheid"
      },
    "adresStatus": "InGebruik",
    "officieelToegekend": true
}
EOT;

    /**
     * Json data is normalized into an AddressDetail value.
     *
     * @test
     */
    public function jsonDataIsNormalized(): void
    {
        $expected = new AddressDetail(
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
            new Lambert72Point(105600.61, 19113.19)
        );

        $normalizer = new AddressDetailNormalizer();
        $jsonData = json_decode($this->json);

        $this->assertEquals(
            $expected,
            $normalizer->normalize($jsonData)
        );
    }
}
