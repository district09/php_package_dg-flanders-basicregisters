<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Value\Address;

use DigipolisGent\Flanders\BasicRegisters\Value\Address\Address;
use DigipolisGent\Flanders\BasicRegisters\Value\Address\AddressDetail;
use DigipolisGent\Flanders\BasicRegisters\Value\Address\AddressId;
use DigipolisGent\Flanders\BasicRegisters\Value\Address\FullAddress;
use DigipolisGent\Flanders\BasicRegisters\Value\Geographical\GeographicalName;
use DigipolisGent\Flanders\BasicRegisters\Value\LanguageCode;
use DigipolisGent\Flanders\BasicRegisters\Value\Municipality\Municipality;
use DigipolisGent\Flanders\BasicRegisters\Value\Municipality\MunicipalityName;
use DigipolisGent\Flanders\BasicRegisters\Value\Municipality\MunicipalityNameId;
use DigipolisGent\Flanders\BasicRegisters\Value\Position\Lambert72Point;
use DigipolisGent\Flanders\BasicRegisters\Value\Position\PointInterface;
use DigipolisGent\Flanders\BasicRegisters\Value\Post\PostInfoId;
use DigipolisGent\Flanders\BasicRegisters\Value\Street\StreetName;
use DigipolisGent\Flanders\BasicRegisters\Value\Street\StreetNameId;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Value\Address\AddressDetail
 */
class AddressDetailTest extends TestCase
{
    /**
     * Address details are created from its details.
     *
     * @test
     */
    public function valueIsCreatedFromItsDetails(): void
    {
        $municipality = $this->createMunicipality(200, 'Gent', 9000);
        $streetName = $this->createStreetName(300, 'Bellevue');
        $position = $this->createPosition(10123, 200123);

        $details = new AddressDetail(
            $this->createAddress(100, 'Bellevue 1 bus D, 9123 Gent', '1', 'D'),
            $municipality,
            $streetName,
            $position
        );

        $this->assertEquals(new AddressId(100), $details->addressId());
        $this->assertSame($municipality, $details->municipality());
        $this->assertSame($streetName, $details->streetName());
        $this->assertSame('1', $details->houseNumber());
        $this->assertSame('D', $details->busNumber());
        $this->assertSame($position, $details->position());
    }

    /**
     * Not the same value if the address object id is not identical.
     *
     * @test
     */
    public function notSameIfAddressObjectIdIsNotIdentical(): void
    {
        $address = $this->createAddress(100, 'Bellevue 1 bus D, 9123 Gent', '1', 'D');
        $municipality = $this->createMunicipality(200, 'Gent', 9000);
        $streetName = $this->createStreetName(300, 'Bellevue');
        $position = $this->createPosition(10123, 200123);

        $details = new AddressDetail($address, $municipality, $streetName, $position);

        $otherDetails = new AddressDetail(
            $this->createAddress(101, 'Bellevue 1 bus D, 9123 Gent', '1', 'D'),
            $municipality,
            $streetName,
            $position
        );

        $this->assertFalse($details->sameValueAs($otherDetails));
    }

    /**
     * Not the same value if the municipality object is not identical.
     *
     * @test
     */
    public function notSameIfMunicipalityIsNotIdentical(): void
    {
        $address = $this->createAddress(100, 'Bellevue 1 bus D, 9123 Gent', '1', 'D');
        $municipality = $this->createMunicipality(200, 'Gent', 9000);
        $streetName = $this->createStreetName(300, 'Bellevue');
        $position = $this->createPosition(10123, 200123);

        $details = new AddressDetail($address, $municipality, $streetName, $position);

        $otherDetails = new AddressDetail(
            $address,
            $this->createMunicipality(201, 'Gent', 9123),
            $streetName,
            $position
        );

        $this->assertFalse($details->sameValueAs($otherDetails));
    }

    /**
     * Not the same value if the street name is not identical.
     *
     * @test
     */
    public function notSameIfStreetNameIsNotIdentical(): void
    {
        $address = $this->createAddress(100, 'Bellevue 1 bus D, 9123 Gent', '1', 'D');
        $municipality = $this->createMunicipality(200, 'Gent', 9000);
        $streetName = $this->createStreetName(300, 'Bellevue');
        $position = $this->createPosition(10123, 200123);

        $details = new AddressDetail($address, $municipality, $streetName, $position);

        $otherDetails = new AddressDetail(
            $address,
            $municipality,
            $this->createStreetName(301, 'Bellevue'),
            $position
        );

        $this->assertFalse($details->sameValueAs($otherDetails));
    }

    /**
     * Not the same value if the position is not identical.
     *
     * @test
     */
    public function notSameIfPositionIsNotIdentical(): void
    {
        $address = $this->createAddress(100, 'Bellevue 1 bus D, 9123 Gent', '1', 'D');
        $municipality = $this->createMunicipality(200, 'Gent', 9000);
        $streetName = $this->createStreetName(300, 'Bellevue');
        $position = $this->createPosition(10123, 200123);

        $details = new AddressDetail($address, $municipality, $streetName, $position);

        $otherDetails = new AddressDetail(
            $address,
            $municipality,
            $streetName,
            $this->createPosition(10124, 200124)
        );

        $this->assertFalse($details->sameValueAs($otherDetails));
    }

    /**
     * Same if all details are identical.
     *
     * @test
     */
    public function sameIfAllDetailsAreIdentical(): void
    {
        $address = $this->createAddress(100, 'Bellevue 1 bus D, 9123 Gent', '1', 'D');
        $municipality = $this->createMunicipality(200, 'Gent', 9000);
        $streetName = $this->createStreetName(300, 'Bellevue');
        $position = $this->createPosition(10123, 200123);

        $details = new AddressDetail($address, $municipality, $streetName, $position);
        $otherDetails = new AddressDetail(
            $address,
            $municipality,
            $streetName,
            $position
        );

        $this->assertTrue($details->sameValueAs($otherDetails));
    }

    /**
     * Casting to string returns the Address casted to string.
     *
     * @test
     */
    public function castToStringReturnsAddressCastedToString(): void
    {
        $address = $this->createAddress(100, 'Bellevue 1 bus D, 9123 Gent', '1', 'D');
        $municipality = $this->createMunicipality(200, 'Gent', 9000);
        $streetName = $this->createStreetName(300, 'Bellevue');
        $position = $this->createPosition(10123, 200123);

        $details = new AddressDetail($address, $municipality, $streetName, $position);

        $this->assertSame((string) $address, (string) $details);
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

    /**
     * Create a municipality object.
     *
     * @param int $identifier
     * @param string $name
     * @param int $postInfoIdentifier
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\Municipality\Municipality
     */
    private function createMunicipality(int $identifier, string $name, int $postInfoIdentifier): Municipality
    {
        return new Municipality(
            new PostInfoId($postInfoIdentifier),
            new MunicipalityName(
                new MunicipalityNameId($identifier),
                new GeographicalName(
                    new LanguageCode('NL'),
                    $name
                )
            )
        );
    }

    /**
     * Create street name object.
     *
     * @param int $identifier
     * @param string $name
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\Street\StreetName
     */
    private function createStreetName(int $identifier, string $name): StreetName
    {
        return new StreetName(
            new StreetNameId($identifier),
            new GeographicalName(
                new LanguageCode('NL'),
                $name
            )
        );
    }

    /**
     * Create position object.
     *
     * @param float $xPosition
     * @param float $yPosition
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\Position\PointInterface
     */
    private function createPosition(float $xPosition, float $yPosition): PointInterface
    {
        return new Lambert72Point($xPosition, $yPosition);
    }
}
