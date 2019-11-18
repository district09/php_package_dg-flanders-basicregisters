<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Normalize\FromJson\Locality;

use DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\Locality\LocalityNameNormalizer;
use DigipolisGent\Flanders\BasicRegisters\Value\Geographical\GeographicalName;
use DigipolisGent\Flanders\BasicRegisters\Value\LanguageCode;
use DigipolisGent\Flanders\BasicRegisters\Value\Locality\LocalityName;
use DigipolisGent\Flanders\BasicRegisters\Value\Locality\LocalityNameId;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\Locality\LocalityNameNormalizer
 */
class LocalityNameNormalizerTest extends TestCase
{
    /**
     * Json data to test with.
     *
     * @var string
     */
    private $json = <<<EOT
{
    "objectId": "44021",
    "detail": "https://basisregisters.vlaanderen.be/api/v1/gemeenten/44021",
    "gemeentenaam": {
        "geografischeNaam": {
            "spelling": "Gent",
            "taal": "NL"
        }
    }
}
EOT;

    /**
     * Json data is normalized into a StreetNameDetail value.
     *
     * @test
     */
    public function jsonDataIsNormalizedIntoStreetNameDetailValue(): void
    {
        $expected = new LocalityName(
            new LocalityNameId(44021),
            new GeographicalName(
                new LanguageCode('NL'),
                'Gent'
            )
        );

        $normalizer = new LocalityNameNormalizer();
        $jsonData = json_decode($this->json);

        $this->assertEquals(
            $expected,
            $normalizer->normalize($jsonData)
        );
    }
}
