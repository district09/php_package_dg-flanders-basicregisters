<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Normalize\FromJson;

use DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\GeographicalNamesNormalizer;
use DigipolisGent\Flanders\BasicRegisters\Value\GeographicalName;
use DigipolisGent\Flanders\BasicRegisters\Value\GeographicalNames;
use DigipolisGent\Flanders\BasicRegisters\Value\LanguageCode;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\GeographicalNamesNormalizer
 */
class GeographicalNamesNormalizerTest extends TestCase
{
    /**
     * Json data to test with.
     *
     * @var string
     */
    private $json = <<<EOT
[
    {
        "spelling": "Gent",
        "taal": "NL"
    },
    {
        "spelling": "Ghent",
        "taal": "EN"
    },
    {
        "spelling": "Gand",
        "taal": "FR"
    }
]
EOT;

    /**
     * Json data is normalized into a GeographicalName value.
     *
     * @test
     */
    public function jsonDataIsNormalizedIntoGeographicalNameValue(): void
    {
        $expected = new GeographicalNames(
            new GeographicalName(
                new LanguageCode('NL'),
                'Gent'
            ),
            new GeographicalName(
                new LanguageCode('EN'),
                'Ghent'
            ),
            new GeographicalName(
                new LanguageCode('FR'),
                'Gand'
            )
        );

        $normalizer = new GeographicalNamesNormalizer();
        $jsonData = json_decode($this->json);

        $this->assertEquals(
            $expected,
            $normalizer->normalize($jsonData)
        );
    }
}
