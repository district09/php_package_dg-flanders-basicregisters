<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Normalize\FromJson\Municipality;

use DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\Post\PostInfosNormalizer;
use DigipolisGent\Flanders\BasicRegisters\Value\Geographical\GeographicalName;
use DigipolisGent\Flanders\BasicRegisters\Value\LanguageCode;
use DigipolisGent\Flanders\BasicRegisters\Value\Post\PostInfo;
use DigipolisGent\Flanders\BasicRegisters\Value\Post\PostInfoId;
use DigipolisGent\Flanders\BasicRegisters\Value\Post\PostInfoNames;
use DigipolisGent\Flanders\BasicRegisters\Value\Post\PostInfos;
use DigipolisGent\Tests\Flanders\BasicRegisters\TestCase;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\Post\PostInfosNormalizer
 */
class PostInfosNormalizerTest extends TestCase
{
    /**
     * Json data to test with.
     *
     * @var string
     */
    private $json = <<<EOT
{
    "postInfoObjecten": [
        {
            "identificator": {
                "id": "https://data.vlaanderen.be/id/postinfo/9000",
                "naamruimte": "https://data.vlaanderen.be/id/postinfo",
                "objectId": "9000",
                "versieId": 1
            },
            "detail": "https://basisregisters.vlaanderen.be/api/v1/postinfo/9000",
            "postnamen": [
                {
                    "geografischeNaam": {
                        "spelling": "GENT",
                        "taal": "NL"
                    }
                }
            ]
        },
        {
            "identificator": {
                "id": "https://data.vlaanderen.be/id/postinfo/9030",
                "naamruimte": "https://data.vlaanderen.be/id/postinfo",
                "objectId": "9030",
                "versieId": 1
            },
            "detail": "https://basisregisters.vlaanderen.be/api/v1/postinfo/9030",
            "postnamen": [
                {
                    "geografischeNaam": {
                        "spelling": "Mariakerke",
                        "taal": "NL"
                    }
                }
            ]
        }
    ],
    "totaalAantal": 10,
    "volgende": "https://basisregisters.vlaanderen.be/api/v1/postinfo?Gemeentenaam=gent&Offset=2&Limit=2"
}
EOT;

    /**
     * Json data is normalized into a PostInfos collection.
     *
     * @test
     */
    public function jsonDataIsNormalized(): void
    {
        $expected = new PostInfos(
            new PostInfo(
                new PostInfoId(9000),
                new PostInfoNames(
                    new GeographicalName(
                        new LanguageCode('NL'),
                        'GENT'
                    )
                )
            ),
            new PostInfo(
                new PostInfoId(9030),
                new PostInfoNames(
                    new GeographicalName(
                        new LanguageCode('NL'),
                        'Mariakerke'
                    )
                )
            )
        );

        $normalizer = new PostInfosNormalizer();
        $jsonData = json_decode($this->json);

        $this->assertEquals(
            $expected,
            $normalizer->normalize($jsonData)
        );
    }
}
