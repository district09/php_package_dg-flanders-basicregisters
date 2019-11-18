<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Normalize\FromJson;

use DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\StreetNameNormalizer;
use DigipolisGent\Flanders\BasicRegisters\Value\GeographicalName;
use DigipolisGent\Flanders\BasicRegisters\Value\LanguageCode;
use DigipolisGent\Flanders\BasicRegisters\Value\StreetName;
use DigipolisGent\Flanders\BasicRegisters\Value\StreetNameId;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\StreetNameNormalizer
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
        "objectId": "69497"
    },
    "straatnaam": {
        "geografischeNaam": {
            "spelling": "Alphonse Claeys-Boúúaertdreef",
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
    public function jsonDataIsNormalizedIntoStreetNameValue(): void
    {
        $expected = new StreetName(
            new StreetNameId(69497),
            new GeographicalName(
                new LanguageCode('NL'),
                'Alphonse Claeys-Boúúaertdreef'
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
