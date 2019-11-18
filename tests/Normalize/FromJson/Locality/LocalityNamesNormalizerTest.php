<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Normalize\FromJson\Locality;

use DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\Locality\LocalityNamesNormalizer;
use DigipolisGent\Flanders\BasicRegisters\Value\Geographical\GeographicalName;
use DigipolisGent\Flanders\BasicRegisters\Value\LanguageCode;
use DigipolisGent\Flanders\BasicRegisters\Value\Locality\LocalityName;
use DigipolisGent\Flanders\BasicRegisters\Value\Locality\LocalityNameId;
use DigipolisGent\Flanders\BasicRegisters\Value\Locality\LocalityNames;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\Locality\LocalityNamesNormalizer
 */
class LocalityNamesNormalizerTest extends TestCase
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
     * Json data is normalized into a LocalityNames collection.
     *
     * @test
     */
    public function jsonDataIsNormalized(): void
    {
        $expected = new LocalityNames(
            new LocalityName(
                new LocalityNameId(11002),
                new GeographicalName(
                    new LanguageCode('NL'),
                    'Antwerpen'
                )
            ),
            new LocalityName(
                new LocalityNameId(44021),
                new GeographicalName(
                    new LanguageCode('NL'),
                    'Gent'
                )
            )
        );

        $normalizer = new LocalityNamesNormalizer();
        $jsonData = json_decode($this->json);

        $this->assertEquals(
            $expected,
            $normalizer->normalize($jsonData)
        );
    }
}
