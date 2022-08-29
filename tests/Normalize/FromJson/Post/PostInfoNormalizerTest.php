<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Normalize\FromJson\Municipality;

use DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\Post\PostInfoNormalizer;
use DigipolisGent\Flanders\BasicRegisters\Value\Geographical\GeographicalName;
use DigipolisGent\Flanders\BasicRegisters\Value\LanguageCode;
use DigipolisGent\Flanders\BasicRegisters\Value\Post\PostInfo;
use DigipolisGent\Flanders\BasicRegisters\Value\Post\PostInfoId;
use DigipolisGent\Flanders\BasicRegisters\Value\Post\PostInfoNames;
use DigipolisGent\Tests\Flanders\BasicRegisters\TestCase;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\Post\PostInfoNormalizer
 */
class PostInfoNormalizerTest extends TestCase
{
    /**
     * Json data to test with.
     *
     * @var string
     */
    private $json = <<<EOT
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
                "spelling": "Ename",
                "taal": "NL"
            }
        },
        {
            "geografischeNaam": {
                "spelling": "OUDENAARDE",
                "taal": "NL"
            }
        }
    ]
}
EOT;

    /**
     * Json data is normalized into a PostInfo value.
     *
     * @test
     */
    public function jsonDataIsNormalized(): void
    {
        $expected = new PostInfo(
            new PostInfoId(9000),
            new PostInfoNames(
                new GeographicalName(
                    new LanguageCode('NL'),
                    'Ename'
                ),
                new GeographicalName(
                    new LanguageCode('NL'),
                    'OUDENAARDE'
                )
            )
        );

        $normalizer = new PostInfoNormalizer();
        $jsonData = json_decode($this->json);

        $this->assertEquals(
            $expected,
            $normalizer->normalize($jsonData)
        );
    }
}
