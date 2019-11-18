<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Normalize\FromJson\Address;

use DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\Address\AddressesNormalizer;
use DigipolisGent\Flanders\BasicRegisters\Value\Address\Address;
use DigipolisGent\Flanders\BasicRegisters\Value\Address\Addresses;
use DigipolisGent\Flanders\BasicRegisters\Value\Address\AddressId;
use DigipolisGent\Flanders\BasicRegisters\Value\Address\FullAddress;
use DigipolisGent\Flanders\BasicRegisters\Value\LanguageCode;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\Address\AddressesNormalizer
 */
class AddressesNormalizerTest extends TestCase
{
    /**
     * Json data to test with.
     *
     * @var string
     */
    private $json = <<<EOT
{
    "adressen": [
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
        },
        {
            "identificator": {
                "id": "https://data.vlaanderen.be/id/adres/2544648",
                "naamruimte": "https://data.vlaanderen.be/id/adres",
                "objectId": "2544648",
                "versieId": 33
            },
            "detail": "https://basisregisters.vlaanderen.be/api/v1/adressen/2544648",
            "huisnummer": "6",
            "busnummer": "",
            "volledigAdres": {
                "geografischeNaam": {
                    "spelling": "Bellevue 6, 9050 Gent",
                    "taal": "NL"
                }
            }
        }
    ],
    "totaalAantal": 2,
    "volgende": "https://basisregisters.vlaanderen.be/api/v1/adressen?gemeentenaam=gent&postcode=9050&straatnaam=Bellevue&offset=0&limit=2"
}
EOT;

    /**
     * Json data is normalized into an Addresses collection.
     *
     * @test
     */
    public function jsonDataIsNormalized(): void
    {
        $expected = new Addresses(
            new Address(
                new AddressId(2550151),
                '1',
                '',
                $expected = new FullAddress(
                    new LanguageCode('NL'),
                    'Bellevue 1, 9050 Gent'
                )
            ),
            new Address(
                new AddressId(2544648),
                '6',
                '',
                $expected = new FullAddress(
                    new LanguageCode('NL'),
                    'Bellevue 6, 9050 Gent'
                )
            )
        );

        $normalizer = new AddressesNormalizer();
        $jsonData = json_decode($this->json);

        $this->assertEquals(
            $expected,
            $normalizer->normalize($jsonData)
        );
    }
}
