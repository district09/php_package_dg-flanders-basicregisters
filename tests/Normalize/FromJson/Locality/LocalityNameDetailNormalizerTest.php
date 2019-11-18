<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Normalize\FromJson\Locality;

use DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\Locality\LocalityNameDetailNormalizer;
use DigipolisGent\Flanders\BasicRegisters\Value\Geographical\GeographicalName;
use DigipolisGent\Flanders\BasicRegisters\Value\Geographical\GeographicalNames;
use DigipolisGent\Flanders\BasicRegisters\Value\LanguageCode;
use DigipolisGent\Flanders\BasicRegisters\Value\Locality\LocalityNameDetail;
use DigipolisGent\Flanders\BasicRegisters\Value\Locality\LocalityNameId;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\Locality\LocalityNameDetailNormalizer
 */
class LocalityNameDetailNormalizerTest extends TestCase
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
     * Json data is normalized into a StreetNameDetail value.
     *
     * @test
     */
    public function jsonDataIsNormalizedIntoStreetNameDetailValue(): void
    {
        $expected = new LocalityNameDetail(
            new LocalityNameId(44021),
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

        $normalizer = new LocalityNameDetailNormalizer();
        $jsonData = json_decode($this->json);

        $this->assertEquals(
            $expected,
            $normalizer->normalize($jsonData)
        );
    }
}
