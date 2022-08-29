<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Normalize\FromJson\Street;

use DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\Street\StreetNameDetailNormalizer;
use DigipolisGent\Flanders\BasicRegisters\Value\Geographical\GeographicalName;
use DigipolisGent\Flanders\BasicRegisters\Value\Geographical\GeographicalNames;
use DigipolisGent\Flanders\BasicRegisters\Value\LanguageCode;
use DigipolisGent\Flanders\BasicRegisters\Value\Municipality\MunicipalityName;
use DigipolisGent\Flanders\BasicRegisters\Value\Municipality\MunicipalityNameId;
use DigipolisGent\Flanders\BasicRegisters\Value\Street\StreetNameDetail;
use DigipolisGent\Flanders\BasicRegisters\Value\Street\StreetNameId;
use DigipolisGent\Tests\Flanders\BasicRegisters\TestCase;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\Street\StreetNameDetailNormalizer
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
        "id": "https://data.vlaanderen.be/id/straatnaam/69683",
        "naamruimte": "https://data.vlaanderen.be/id/straatnaam",
        "objectId": "69683",
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
            "spelling": "Bellevue",
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
    public function jsonDataIsNormalized(): void
    {
        $expected = new StreetNameDetail(
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

        $normalizer = new StreetNameDetailNormalizer();
        $jsonData = json_decode($this->json);

        $this->assertEquals(
            $expected,
            $normalizer->normalize($jsonData)
        );
    }
}
