<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Normalize\FromJson\Address;

use DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\Address\FullAddressNormalizer;
use DigipolisGent\Flanders\BasicRegisters\Value\Address\FullAddress;
use DigipolisGent\Flanders\BasicRegisters\Value\LanguageCode;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\Address\FullAddressNormalizer
 */
class FullAddressNormalizerTest extends TestCase
{
    /**
     * Json data to test with.
     *
     * @var string
     */
    private $json = <<<EOT
{
    "geografischeNaam": {
        "spelling": "Bellevue 1, 9050 Gent",
        "taal": "NL"
    }
}
EOT;

    /**
     * Json data is normalized into a FullAddress value.
     *
     * @test
     */
    public function jsonDataIsNormalized(): void
    {
        $expected = new FullAddress(
            new LanguageCode('NL'),
            'Bellevue 1, 9050 Gent'
        );

        $normalizer = new FullAddressNormalizer();
        $jsonData = json_decode($this->json);

        $this->assertEquals(
            $expected,
            $normalizer->normalize($jsonData)
        );
    }
}
