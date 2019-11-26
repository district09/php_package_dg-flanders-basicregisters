<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Normalize\FromJson\Municipality;

use DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\Municipality\MunicipalityNameNormalizer;
use DigipolisGent\Flanders\BasicRegisters\Value\Geographical\GeographicalName;
use DigipolisGent\Flanders\BasicRegisters\Value\LanguageCode;
use DigipolisGent\Flanders\BasicRegisters\Value\Municipality\MunicipalityName;
use DigipolisGent\Flanders\BasicRegisters\Value\Municipality\MunicipalityNameId;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\Municipality\MunicipalityNameNormalizer
 */
class MunicipalityNameNormalizerTest extends TestCase
{
    /**
     * Json data to test with.
     *
     * @var string
     */
    private $json = <<<EOT
{
    "objectId": "44021",
    "detail": "https://basisregisters.vlaanderen.be/api/v1/gemeenten/44021",
    "gemeentenaam": {
        "geografischeNaam": {
            "spelling": "Gent",
            "taal": "NL"
        }
    }
}
EOT;

    /**
     * Json data is normalized into a MunicipalityName value.
     *
     * @test
     */
    public function jsonDataIsNormalized(): void
    {
        $expected = new MunicipalityName(
            new MunicipalityNameId(44021),
            new GeographicalName(
                new LanguageCode('NL'),
                'Gent'
            )
        );

        $normalizer = new MunicipalityNameNormalizer();
        $jsonData = json_decode($this->json);

        $this->assertEquals(
            $expected,
            $normalizer->normalize($jsonData)
        );
    }
}
