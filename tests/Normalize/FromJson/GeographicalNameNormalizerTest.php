<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Normalize\FromJson;

use DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\GeographicalNameNormalizer;
use DigipolisGent\Flanders\BasicRegisters\Value\Geographical\GeographicalName;
use DigipolisGent\Flanders\BasicRegisters\Value\LanguageCode;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\GeographicalNameNormalizer
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
    "spelling": "Aaigemstraat",
    "taal": "NL"
}
EOT;

    /**
     * Json data is normalized into a GeographicalName value.
     *
     * @test
     */
    public function jsonDataIsNormalizedIntoGeographicalNameValue(): void
    {
        $expected = new GeographicalName(
            new LanguageCode('NL'),
            'Aaigemstraat'
        );

        $normalizer = new GeographicalNameNormalizer();
        $jsonData = json_decode($this->json);

        $this->assertEquals(
            $expected,
            $normalizer->normalize($jsonData)
        );
    }
}
