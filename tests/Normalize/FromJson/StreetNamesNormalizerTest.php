<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Normalize\FromJson;

use DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\StreetNamesNormalizer;
use DigipolisGent\Flanders\BasicRegisters\Value\Geographical\GeographicalName;
use DigipolisGent\Flanders\BasicRegisters\Value\LanguageCode;
use DigipolisGent\Flanders\BasicRegisters\Value\Street\StreetName;
use DigipolisGent\Flanders\BasicRegisters\Value\Street\StreetNameId;
use DigipolisGent\Flanders\BasicRegisters\Value\Street\StreetNames;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\StreetNamesNormalizer
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
                "objectId": "69497"
            },
            "straatnaam": {
                "geografischeNaam": {
                    "spelling": "Alphonse Claeys-Boúúaertdreef",
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
    public function jsonDataIsNormalizedIntoStreetNamesCollection(): void
    {
        $expected = new StreetNames(
            new StreetName(
                new StreetNameId(69497),
                new GeographicalName(
                    new LanguageCode('NL'),
                    'Alphonse Claeys-Boúúaertdreef'
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
