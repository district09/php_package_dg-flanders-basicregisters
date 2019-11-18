<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Value;

use DigipolisGent\Flanders\BasicRegisters\Value\Address\Address;
use DigipolisGent\Flanders\BasicRegisters\Value\Address\AddressId;
use DigipolisGent\Flanders\BasicRegisters\Value\Address\FullAddress;
use DigipolisGent\Flanders\BasicRegisters\Value\LanguageCode;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Value\Address\Address
 */
class AddressTest extends TestCase
{
    /**
     * Address is created from its details.
     *
     * @test
     */
    public function addressIsCreatedFromItsDetails(): void
    {
        $objectId = new AddressId(1793);
        $fullAddress = new FullAddress(
            new LanguageCode('NL'),
            'Bellevue 121 bus D, 9000 Gent'
        );

        $address = new Address($objectId, '121', 'D', $fullAddress);

        $this->assertSame($objectId, $address->addressId());
        $this->assertSame('121', $address->houseNumber());
        $this->assertSame('D', $address->busNumber());
        $this->assertSame($fullAddress, $address->fullAddress());
    }

    /**
     * Not the same value if the object is is not identical.
     *
     * @test
     */
    public function notSameIfObjectIdIsNotIdentical(): void
    {
        $objectId = new AddressId(1793);
        $fullAddress = new FullAddress(
            new LanguageCode('NL'),
            'Bellevue 121 bus D, 9000 Gent'
        );

        $address = new Address($objectId, '121', 'D', $fullAddress);

        $otherObjectId = new AddressId(123);
        $otherAddress = new Address($otherObjectId, '121', 'D', $fullAddress);

        $this->assertFalse($address->sameValueAs($otherAddress));
    }

    /**
     * Not the same value if the house number is not identical.
     *
     * @test
     */
    public function notSameIfHouseNumberIsNotIdentical(): void
    {
        $objectId = new AddressId(1793);
        $fullAddress = new FullAddress(
            new LanguageCode('NL'),
            'Bellevue 121 bus D, 9000 Gent'
        );

        $address = new Address($objectId, '121', 'D', $fullAddress);
        $otherAddress = new Address($objectId, '212', 'D', $fullAddress);

        $this->assertFalse($address->sameValueAs($otherAddress));
    }

    /**
     * Not the same value if the bus number is not identical.
     *
     * @test
     */
    public function notSameIfBusNumberIsNotIdentical(): void
    {
        $objectId = new AddressId(1793);
        $fullAddress = new FullAddress(
            new LanguageCode('NL'),
            'Bellevue 121 bus D, 9000 Gent'
        );

        $address = new Address($objectId, '121', 'D', $fullAddress);
        $otherAddress = new Address($objectId, '121', 'A', $fullAddress);

        $this->assertFalse($address->sameValueAs($otherAddress));
    }

    /**
     * Not the same value if the full address is not identical.
     *
     * @test
     */
    public function notSameIfFullAddressIsNotIdentical(): void
    {
        $objectId = new AddressId(1793);
        $fullAddress = new FullAddress(
            new LanguageCode('NL'),
            'Bellevue 121 bus D, 9000 Gent'
        );

        $address = new Address($objectId, '121', 'D', $fullAddress);

        $otherFullAddress = new FullAddress(
            new LanguageCode('NL'),
            'Bellevue 212 bus A, 9000 Gent'
        );
        $otherAddress = new Address($objectId, '121', 'D', $otherFullAddress);

        $this->assertFalse($address->sameValueAs($otherAddress));
    }

    /**
     * Same value if all details are identical.
     *
     * @test
     */
    public function sameIfAllDetailsAreIdentical(): void
    {
        $objectId = new AddressId(1793);
        $fullAddress = new FullAddress(
            new LanguageCode('NL'),
            'Bellevue 121 bus D, 9000 Gent'
        );

        $address = new Address($objectId, '121', 'D', $fullAddress);
        $otherAddress = new Address($objectId, '121', 'D', $fullAddress);

        $this->assertTrue($address->sameValueAs($otherAddress));
    }

    /**
     * Casting to string returns the full address name value.
     *
     * @test
     */
    public function castToStringReturnsFullAddressName(): void
    {
        $objectId = new AddressId(1793);
        $fullAddress = new FullAddress(
            new LanguageCode('NL'),
            'Bellevue 121 bus D, 9000 Gent'
        );

        $address = new Address($objectId, '121', 'D', $fullAddress);

        $this->assertSame($fullAddress->spelling(), (string) $address);
    }
}
