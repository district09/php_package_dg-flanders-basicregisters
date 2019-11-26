<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Normalize\FromJson\Municipality;

use DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\Municipality\MunicipalityNameDetailNormalizer;
use DigipolisGent\Flanders\BasicRegisters\Value\Geographical\GeographicalName;
use DigipolisGent\Flanders\BasicRegisters\Value\Geographical\GeographicalNames;
use DigipolisGent\Flanders\BasicRegisters\Value\LanguageCode;
use DigipolisGent\Flanders\BasicRegisters\Value\Municipality\MunicipalityNameDetail;
use DigipolisGent\Flanders\BasicRegisters\Value\Municipality\MunicipalityNameId;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\Municipality\MunicipalityNameDetailNormalizer
 */
class MunicipalityNameDetailNormalizerTest extends TestCase
{
    /**
     * Json data to test with.
     *
     * @var string
     */
    private $json = <<<EOT
{
    "identificator": {
        "id": "https://data.vlaanderen.be/id/gemeente/44021",
        "naamruimte": "https://data.vlaanderen.be/id/gemeente",
        "objectId": "44021",
        "versieId": 4
    },
    "gemeentenamen": [
        {
            "spelling": "Gent",
            "taal": "DE"
        },
        {
            "spelling": "Gand",
            "taal": "FR"
        },
        {
            "spelling": "Gent",
            "taal": "NL"
        }
    ],
    "gemeenteStatus": "InGebruik"
}
EOT;

    /**
     * Json data is normalized into a MunicipalityNameDetail value.
     *
     * @test
     */
    public function jsonDataIsNormalized(): void
    {
        $expected = new MunicipalityNameDetail(
            new MunicipalityNameId(44021),
            new GeographicalNames(
                new GeographicalName(
                    new LanguageCode('DE'),
                    'Gent'
                ),
                new GeographicalName(
                    new LanguageCode('FR'),
                    'Gand'
                ),
                new GeographicalName(
                    new LanguageCode('NL'),
                    'Gent'
                )
            )
        );

        $normalizer = new MunicipalityNameDetailNormalizer();
        $jsonData = json_decode($this->json);

        $this->assertEquals(
            $expected,
            $normalizer->normalize($jsonData)
        );
    }
}
