<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Normalize\FromJson\Address;

use DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\Address\AddressNormalizer;
use DigipolisGent\Flanders\BasicRegisters\Value\Address\Address;
use DigipolisGent\Flanders\BasicRegisters\Value\Address\AddressId;
use DigipolisGent\Flanders\BasicRegisters\Value\Address\FullAddress;
use DigipolisGent\Flanders\BasicRegisters\Value\LanguageCode;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\Address\AddressNormalizer
 */
class AddressNormalizerTest extends TestCase
{
    /**
     * Json data to test with.
     *
     * @var string
     */
    private $json = <<<EOT
{
    "identificator": {
        "id": "https://data.vlaanderen.be/id/adres/2550151",
        "naamruimte": "https://data.vlaanderen.be/id/adres",
        "objectId": "2550151",
        "versieId": 25
    },
    "detail": "https://basisregisters.vlaanderen.be/api/v1/adressen/2550151",
    "huisnummer": "1",
    "busnummer": "",
    "volledigAdres": {
        "geografischeNaam": {
            "spelling": "Bellevue 1, 9050 Gent",
            "taal": "NL"
        }
    }
}
EOT;

    /**
     * Incomplete json data to test with.
     *
     * Huisnummer & busnummer are optional fields.
     *
     * @var string
     */
    private $incompleteJson = <<<EOT
{
    "identificator": {
        "id": "https://data.vlaanderen.be/id/adres/2550151",
        "naamruimte": "https://data.vlaanderen.be/id/adres",
        "objectId": "2550151",
        "versieId": 25
    },
    "detail": "https://basisregisters.vlaanderen.be/api/v1/adressen/2550151",
    "volledigAdres": {
        "geografischeNaam": {
            "spelling": "Bellevue, 9050 Gent",
            "taal": "NL"
        }
    }
}
EOT;

    /**
     * Json data is normalized into a Address value.
     *
     * @test
     */
    public function jsonDataIsNormalized(): void
    {
        $expected = new Address(
            new AddressId(2550151),
            '1',
            '',
            $expected = new FullAddress(
                new LanguageCode('NL'),
                'Bellevue 1, 9050 Gent'
            )
        );

        $normalizer = new AddressNormalizer();
        $jsonData = json_decode($this->json);

        $this->assertEquals(
            $expected,
            $normalizer->normalize($jsonData)
        );
    }

    /**
     * Incomplete json data is normalized into a Address value.
     *
     * @test
     */
    public function incompleteJsonDataIsNormalized(): void
    {
        $expected = new Address(
            new AddressId(2550151),
            '',
            '',
            $expected = new FullAddress(
                new LanguageCode('NL'),
                'Bellevue, 9050 Gent'
            )
        );

        $normalizer = new AddressNormalizer();
        $jsonData = json_decode($this->incompleteJson);

        $this->assertEquals(
            $expected,
            $normalizer->normalize($jsonData)
        );
    }
}
