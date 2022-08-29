<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Normalize\FromJson\Geographical;

use DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\Geographical\GeographicalNameNormalizer;
use DigipolisGent\Flanders\BasicRegisters\Value\Geographical\GeographicalName;
use DigipolisGent\Flanders\BasicRegisters\Value\LanguageCode;
use DigipolisGent\Tests\Flanders\BasicRegisters\TestCase;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\Geographical\GeographicalNameNormalizer
 */
class GeographicalNameNormalizerTest extends TestCase
{
    /**
     * Json data to test with.
     *
     * @var string
     */
    private $json = <<<EOT
{
    "spelling": "Bellevue",
    "taal": "NL"
}
EOT;

    /**
     * Json data is normalized into a GeographicalName value.
     *
     * @test
     */
    public function jsonDataIsNormalized(): void
    {
        $expected = new GeographicalName(
            new LanguageCode('NL'),
            'Bellevue'
        );

        $normalizer = new GeographicalNameNormalizer();
        $jsonData = json_decode($this->json);

        $this->assertEquals(
            $expected,
            $normalizer->normalize($jsonData)
        );
    }
}
