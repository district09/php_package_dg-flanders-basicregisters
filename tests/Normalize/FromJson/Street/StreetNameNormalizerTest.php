<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Normalize\FromJson\Street;

use DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\Street\StreetNameNormalizer;
use DigipolisGent\Flanders\BasicRegisters\Value\Geographical\GeographicalName;
use DigipolisGent\Flanders\BasicRegisters\Value\LanguageCode;
use DigipolisGent\Flanders\BasicRegisters\Value\Street\StreetName;
use DigipolisGent\Flanders\BasicRegisters\Value\Street\StreetNameId;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\Street\StreetNameNormalizer
 */
class StreetNameNormalizerTest extends TestCase
{
    /**
     * Json data to test with.
     *
     * @var string
     */
    private $json = <<<EOT
{
    "identificator": {
        "objectId": "69683"
    },
    "straatnaam": {
        "geografischeNaam": {
            "spelling": "Bellevue",
            "taal": "NL"
        }
    }
}
EOT;

    /**
     * Json data is normalized into a StreetName value.
     *
     * @test
     */
    public function jsonDataIsNormalized(): void
    {
        $expected = new StreetName(
            new StreetNameId(69683),
            new GeographicalName(
                new LanguageCode('NL'),
                'Bellevue'
            )
        );

        $normalizer = new StreetNameNormalizer();
        $jsonData = json_decode($this->json);

        $this->assertEquals(
            $expected,
            $normalizer->normalize($jsonData)
        );
    }
}
