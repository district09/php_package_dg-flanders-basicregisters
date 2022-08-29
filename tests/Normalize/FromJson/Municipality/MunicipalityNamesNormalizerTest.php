<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Normalize\FromJson\Municipality;

use DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\Municipality\MunicipalityNamesNormalizer;
use DigipolisGent\Flanders\BasicRegisters\Value\Geographical\GeographicalName;
use DigipolisGent\Flanders\BasicRegisters\Value\LanguageCode;
use DigipolisGent\Flanders\BasicRegisters\Value\Municipality\MunicipalityName;
use DigipolisGent\Flanders\BasicRegisters\Value\Municipality\MunicipalityNameId;
use DigipolisGent\Flanders\BasicRegisters\Value\Municipality\MunicipalityNames;
use DigipolisGent\Tests\Flanders\BasicRegisters\TestCase;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\Municipality\MunicipalityNamesNormalizer
 */
class MunicipalityNamesNormalizerTest extends TestCase
{
    /**
     * Json data to test with.
     *
     * @var string
     */
    private $json = <<<EOT
{
    "gemeenten": [
        {
            "identificator": {
                "id": "https://data.vlaanderen.be/id/gemeente/11002",
                "naamruimte": "https://data.vlaanderen.be/id/gemeente",
                "objectId": "11002",
                "versieId": 2
            },
            "detail": "https://basisregisters.vlaanderen.be/api/v1/gemeenten/11002",
            "gemeentenaam": {
                "geografischeNaam": {
                    "spelling": "Antwerpen",
                    "taal": "NL"
                }
            }
        },
        {
            "identificator": {
                "id": "https://data.vlaanderen.be/id/gemeente/44021",
                "naamruimte": "https://data.vlaanderen.be/id/gemeente",
                "objectId": "44021",
                "versieId": 4
            },
            "detail": "https://basisregisters.vlaanderen.be/api/v1/gemeenten/44021",
            "gemeentenaam": {
                "geografischeNaam": {
                    "spelling": "Gent",
                    "taal": "NL"
                }
            }
        }
    ],
    "totaalAantal": 596,
    "volgende": "https://basisregisters.vlaanderen.be/api/v1/gemeenten?offset=0&limit=2"
}
EOT;

    /**
     * Json data is normalized into a MunicipalityNames collection.
     *
     * @test
     */
    public function jsonDataIsNormalized(): void
    {
        $expected = new MunicipalityNames(
            new MunicipalityName(
                new MunicipalityNameId(11002),
                new GeographicalName(
                    new LanguageCode('NL'),
                    'Antwerpen'
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

        $normalizer = new MunicipalityNamesNormalizer();
        $jsonData = json_decode($this->json);

        $this->assertEquals(
            $expected,
            $normalizer->normalize($jsonData)
        );
    }
}
