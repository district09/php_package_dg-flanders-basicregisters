<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Value;

use DigipolisGent\Flanders\BasicRegisters\Value\AddressDetailInterface;
use DigipolisGent\Flanders\BasicRegisters\Value\AddressId;
use DigipolisGent\Flanders\BasicRegisters\Value\AddressMatch;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Value\AddressMatch
 */
class AddressMatchTest extends TestCase
{
    /**
     * Value is created from its details.
     *
     * @test
     */
    public function valueIsCreatedFromItsDetails(): void
    {
        $addressDetail = $this->createAddressDetailMock(100);
        $addressMatch = new AddressMatch($addressDetail, 98.123456);

        $this->assertSame($addressDetail, $addressMatch->addressDetail());
        $this->assertSame(98.123456, $addressMatch->score());
    }

    /**
     * AddressId is extracted from the address detail.
     *
     * @test
     */
    public function addressIdIsExtractedFromAddressDetail(): void
    {
        $addressDetail = $this->createAddressDetailMock(100);
        $addressMatch = new AddressMatch($addressDetail, 88);

        $this->assertEquals(
            new AddressId(100),
            $addressMatch->addressId()
        );
    }

    /**
     * Not same value if the address details are not identical.
     *
     * @test
     */
    public function notSameIfAddressDetailsAreDifferent(): void
    {
        $otherAddressDetails = $this->createAddressDetailMock(100);
        $addressDetails = $this->prophesize(AddressDetailInterface::class);
        $addressDetails->sameValueAs($otherAddressDetails)->willReturn(false);

        $addressMatch = new AddressMatch($addressDetails->reveal(), 99);
        $otherAddressMatch = new AddressMatch($otherAddressDetails, 99);

        $this->assertFalse($addressMatch->sameValueAs($otherAddressMatch));
    }

    /**
     * Same value when the AddressDetails are identical.
     *
     * Score is not taken in account to check if it is the same value.
     *
     * @test
     */
    public function sameIfAddressDetailsAreIdentical(): void
    {
        $sameAddressDetails = $this->createAddressDetailMock(100);
        $addressDetails = $this->prophesize(AddressDetailInterface::class);
        $addressDetails->sameValueAs($sameAddressDetails)->willReturn(true);

        $addressMatch = new AddressMatch($addressDetails->reveal(), 99);
        $sameAddressMatch = new AddressMatch($sameAddressDetails, 88);

        $this->assertTrue($addressMatch->sameValueAs($sameAddressMatch));
    }

    /**
     * Cast to string will return string-casted version of the address detail.
     *
     * @test
     */
    public function castToStringReturnsStringCastOfContractDetail(): void
    {
        $addressDetails = $this->createAddressDetailMock(100);
        $addressMatch = new AddressMatch($addressDetails, 99);

        $this->assertEquals((string) $addressDetails, (string) $addressMatch);
    }

    /**
     * Create an address detail object.
     *
     * @param int $identifier
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\AddressDetailInterface
     */
    private function createAddressDetailMock(int $identifier): AddressDetailInterface
    {
        $adressDetail = $this->prophesize(AddressDetailInterface::class);
        $adressDetail->addressId()->willReturn(new AddressId($identifier));
        $adressDetail->__toString()->willReturn('Street name 123 bus A, 9000 Gent');

        return $adressDetail->reveal();
    }
}
