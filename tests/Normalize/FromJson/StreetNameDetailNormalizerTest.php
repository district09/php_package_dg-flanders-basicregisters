<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Normalize\FromJson;

use DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\StreetNameDetailNormalizer;
use DigipolisGent\Flanders\BasicRegisters\Value\GeographicalName;
use DigipolisGent\Flanders\BasicRegisters\Value\GeographicalNames;
use DigipolisGent\Flanders\BasicRegisters\Value\LanguageCode;
use DigipolisGent\Flanders\BasicRegisters\Value\Locality\LocalityName;
use DigipolisGent\Flanders\BasicRegisters\Value\Locality\LocalityNameId;
use DigipolisGent\Flanders\BasicRegisters\Value\StreetNameDetail;
use DigipolisGent\Flanders\BasicRegisters\Value\StreetNameId;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\StreetNameDetailNormalizer
 */
class StreetNameDetailNormalizerTest extends TestCase
{
    /**
     * Json data to test with.
     *
     * @var string
     */
    private $json = <<<EOT
{
    "identificator": {
        "id": "https://data.vlaanderen.be/id/straatnaam/69497",
        "naamruimte": "https://data.vlaanderen.be/id/straatnaam",
        "objectId": "69497",
        "versieId": 7
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
            "spelling": "Alphonse Claeys-Boúúaertdreef",
            "taal": "NL"
        }
    ],
    "homoniemToevoegingen": [],
    "straatnaamStatus": "InGebruik"
}
EOT;

    /**
     * Json data is normalized into a StreetNameDetail value.
     *
     * @test
     */
    public function jsonDataIsNormalizedIntoStreetNameDetailValue(): void
    {
        $expected = new StreetNameDetail(
            new StreetNameId(69497),
            new GeographicalNames(
                new GeographicalName(
                    new LanguageCode('NL'),
                    'Alphonse Claeys-Boúúaertdreef'
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

        $normalizer = new StreetNameDetailNormalizer();
        $jsonData = json_decode($this->json);

        $this->assertEquals(
            $expected,
            $normalizer->normalize($jsonData)
        );
    }
}
