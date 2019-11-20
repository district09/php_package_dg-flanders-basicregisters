<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Normalize\FromJson\Address;

use DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\Address\AddressMatchesNormalizer;
use DigipolisGent\Flanders\BasicRegisters\Value\Address\Address;
use DigipolisGent\Flanders\BasicRegisters\Value\Address\AddressDetail;
use DigipolisGent\Flanders\BasicRegisters\Value\Address\AddressId;
use DigipolisGent\Flanders\BasicRegisters\Value\Address\AddressMatch;
use DigipolisGent\Flanders\BasicRegisters\Value\Address\AddressMatches;
use DigipolisGent\Flanders\BasicRegisters\Value\Address\FullAddress;
use DigipolisGent\Flanders\BasicRegisters\Value\Geographical\GeographicalName;
use DigipolisGent\Flanders\BasicRegisters\Value\LanguageCode;
use DigipolisGent\Flanders\BasicRegisters\Value\Locality\Locality;
use DigipolisGent\Flanders\BasicRegisters\Value\Locality\LocalityName;
use DigipolisGent\Flanders\BasicRegisters\Value\Locality\LocalityNameId;
use DigipolisGent\Flanders\BasicRegisters\Value\Position\Lambert72Point;
use DigipolisGent\Flanders\BasicRegisters\Value\Post\PostInfoId;
use DigipolisGent\Flanders\BasicRegisters\Value\Street\StreetName;
use DigipolisGent\Flanders\BasicRegisters\Value\Street\StreetNameId;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\Address\AddressMatchesNormalizer
 */
class AddressMatchesNormalizerTest extends TestCase
{
    /**
     * Json data to test with.
     *
     * @var string
     */
    private $json = <<<EOT
{
    "adresMatches": [
        {
            "identificator": {
                "id": "https://data.vlaanderen.be/id/adres/3281807",
                "naamruimte": "https://data.vlaanderen.be/id/adres",
                "objectId": "3281807",
                "versieId": 27
            },
            "detail": "https://basisregisters.vlaanderen.be/api/v1/adressen/3281807",
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
            "homoniemToevoeging": {
                "geografischeNaam": {
                    "spelling": "",
                    "taal": "NL"
                }
            },
            "huisnummer": "5",
            "volledigAdres": {
                "geografischeNaam": {
                    "spelling": "Bellevue 5, 9050 Gent",
                    "taal": "NL"
                }
            },
            "adresPositie": {
                "point": {
                    "coordinates": [
                        105665.73,
                        192054.51
                    ],
                    "type": "Point"
                }
            },
            "positieSpecificatie": "Gebouweenheid",
            "positieGeometrieMethode": "AangeduidDoorBeheerder",
            "adresStatus": "InGebruik",
            "officieelToegekend": true,
            "adresseerbareObjecten": [
                {
                    "objectType": "Gebouweenheid",
                    "objectId": "20124588",
                    "detail": "https://basisregisters.vlaanderen.be/api/v1/gebouweenheden/20124588"
                },
                {
                    "objectType": "Perceel",
                    "objectId": "44032A0472-00N003",
                    "detail": "https://basisregisters.vlaanderen.be/api/v1/percelen/44032A0472-00N003"
                }
            ],
            "score": 100.0
        },
        {
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
            "homoniemToevoeging": {
                "geografischeNaam": {
                    "spelling": "",
                    "taal": "NL"
                }
            },
            "score": 82.341337907375632
        }
    ],
    "warnings": []
}
EOT;

    /**
     * Json data is normalized into an AddressMatches collection.
     *
     * @test
     */
    public function jsonDataIsNormalized(): void
    {
        $expected = new AddressMatches(
            new AddressMatch(
                new LocalityName(
                    new LocalityNameId(44021),
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
                        new AddressId(3281807),
                        '5',
                        '',
                        $expected = new FullAddress(
                            new LanguageCode('NL'),
                            'Bellevue 5, 9050 Gent'
                        )
                    ),
                    new Locality(
                        new PostInfoId(9050),
                        new LocalityName(
                            new LocalityNameId(44021),
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
                    new Lambert72Point(105665.73, 192054.51)
                ),
                100.0
            ),
            new AddressMatch(
                new LocalityName(
                    new LocalityNameId(44021),
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
                82.341337907375632
            )
        );

        $normalizer = new AddressMatchesNormalizer();
        $jsonData = json_decode($this->json);

        $this->assertEquals(
            $expected,
            $normalizer->normalize($jsonData)
        );
    }
}
