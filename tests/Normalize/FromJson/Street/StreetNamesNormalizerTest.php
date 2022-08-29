<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Normalize\FromJson\Street;

use DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\Street\StreetNamesNormalizer;
use DigipolisGent\Flanders\BasicRegisters\Value\Geographical\GeographicalName;
use DigipolisGent\Flanders\BasicRegisters\Value\LanguageCode;
use DigipolisGent\Flanders\BasicRegisters\Value\Street\StreetName;
use DigipolisGent\Flanders\BasicRegisters\Value\Street\StreetNameId;
use DigipolisGent\Flanders\BasicRegisters\Value\Street\StreetNames;
use DigipolisGent\Tests\Flanders\BasicRegisters\TestCase;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\Street\StreetNamesNormalizer
 */
class StreetNamesNormalizerTest extends TestCase
{
    /**
     * Json data to test with.
     *
     * @var string
     */
    private $json = <<<EOT
{
    "straatnamen": [
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
        },
        {
            "identificator": {
                "objectId": "69498"
            },
            "straatnaam": {
                "geografischeNaam": {
                    "spelling": "Aaigemstraat",
                    "taal": "NL"
                }
            }
        }
    ]
}
EOT;

    /**
     * Json data is normalized into a StreetNames collection.
     *
     * @test
     */
    public function jsonDataIsNormalized(): void
    {
        $expected = new StreetNames(
            new StreetName(
                new StreetNameId(69683),
                new GeographicalName(
                    new LanguageCode('NL'),
                    'Bellevue'
                )
            ),
            new StreetName(
                new StreetNameId(69498),
                new GeographicalName(
                    new LanguageCode('NL'),
                    'Aaigemstraat'
                )
            )
        );

        $normalizer = new StreetNamesNormalizer();
        $jsonData = json_decode($this->json);

        $this->assertEquals(
            $expected,
            $normalizer->normalize($jsonData)
        );
    }
}
