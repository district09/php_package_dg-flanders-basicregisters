<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Normalize\FromJson\Geographical;

use DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\Geographical\GeographicalNamesNormalizer;
use DigipolisGent\Flanders\BasicRegisters\Value\Geographical\GeographicalName;
use DigipolisGent\Flanders\BasicRegisters\Value\Geographical\GeographicalNames;
use DigipolisGent\Flanders\BasicRegisters\Value\LanguageCode;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\Geographical\GeographicalNamesNormalizer
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
     * Json data is normalized into a GeographicalNames collection.
     *
     * @test
     */
    public function jsonDataIsNormalized(): void
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
