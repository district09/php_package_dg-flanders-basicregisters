<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Value\Address;

use DigipolisGent\Flanders\BasicRegisters\Value\Address\Address;
use DigipolisGent\Flanders\BasicRegisters\Value\Address\Addresses;
use DigipolisGent\Flanders\BasicRegisters\Value\Address\AddressId;
use DigipolisGent\Flanders\BasicRegisters\Value\Address\FullAddress;
use DigipolisGent\Flanders\BasicRegisters\Value\LanguageCode;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Value\Address\Addresses
 */
class AddressesTest extends TestCase
{
    /**
     * Casting to string returns all address as string.
     *
     * @test
     */
    public function castToStringReturnsAllAddressAsString(): void
    {
        $address1 = $this->createAddress(123, 'Foo 123, 9123 Bar', '123', '');
        $address2 = $this->createAddress(123, 'Foo 124, 9123 Bar', '123', '');
        $addresses = new Addresses($address1, $address2);

        $this->assertEquals(
            'Foo 123, 9123 Bar; Foo 124, 9123 Bar',
            (string) $addresses
        );
    }

    /**
     * Create an address object.
     *
     * @param int $identitifier
     * @param string $fullAddress
     * @param string $houseNumber
     * @param string $busNumber
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\Address\Address
     */
    private function createAddress(
        int $identitifier,
        string $fullAddress,
        string $houseNumber,
        string $busNumber
    ): Address {
        $addressId = new AddressId($identitifier);
        $fullAddress = new FullAddress(
            new LanguageCode('NL'),
            $fullAddress
        );

        return new Address($addressId, $houseNumber, $busNumber, $fullAddress);
    }
}
