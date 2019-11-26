<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Normalize\FromJson\Municipality;

use DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\Post\PostInfoNamesNormalizer;
use DigipolisGent\Flanders\BasicRegisters\Value\Geographical\GeographicalName;
use DigipolisGent\Flanders\BasicRegisters\Value\LanguageCode;
use DigipolisGent\Flanders\BasicRegisters\Value\Post\PostInfoNames;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\Post\PostInfoNamesNormalizer
 */
class PostInfoNamesNormalizerTest extends TestCase
{
    /**
     * Json data to test with.
     *
     * @var string
     */
    private $json = <<<EOT
[
    {
        "geografischeNaam": {
            "spelling": "Ename",
            "taal": "NL"
        }
    },
    {
        "geografischeNaam": {
            "spelling": "Leupegem",
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
EOT;

    /**
     * Json data is normalized into a PostInfos collection.
     *
     * @test
     */
    public function jsonDataIsNormalized(): void
    {
        $expected = new PostInfoNames(
            new GeographicalName(
                new LanguageCode('NL'),
                'Ename'
            ),
            new GeographicalName(
                new LanguageCode('NL'),
                'Leupegem'
            ),
            new GeographicalName(
                new LanguageCode('NL'),
                'OUDENAARDE'
            )
        );

        $normalizer = new PostInfoNamesNormalizer();
        $jsonData = json_decode($this->json);

        $this->assertEquals(
            $expected,
            $normalizer->normalize($jsonData)
        );
    }
}
