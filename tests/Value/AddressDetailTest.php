<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Value;

use DigipolisGent\Flanders\BasicRegisters\Value\Address;
use DigipolisGent\Flanders\BasicRegisters\Value\AddressDetail;
use DigipolisGent\Flanders\BasicRegisters\Value\AddressId;
use DigipolisGent\Flanders\BasicRegisters\Value\FullAddress;
use DigipolisGent\Flanders\BasicRegisters\Value\GeographicalName;
use DigipolisGent\Flanders\BasicRegisters\Value\LanguageCode;
use DigipolisGent\Flanders\BasicRegisters\Value\Locality\Locality;
use DigipolisGent\Flanders\BasicRegisters\Value\Locality\LocalityName;
use DigipolisGent\Flanders\BasicRegisters\Value\Locality\LocalityNameId;
use DigipolisGent\Flanders\BasicRegisters\Value\Position\Lambert72Point;
use DigipolisGent\Flanders\BasicRegisters\Value\Position\PointInterface;
use DigipolisGent\Flanders\BasicRegisters\Value\PostInfoId;
use DigipolisGent\Flanders\BasicRegisters\Value\StreetName;
use DigipolisGent\Flanders\BasicRegisters\Value\StreetNameId;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Value\AddressDetail
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
        $locality = $this->createLocality(200, 'Gent', 9000);
        $streetName = $this->createStreetName(300, 'Street name');
        $position = $this->createPosition(10123, 200123);

        $details = new AddressDetail(
            $this->createAddress(100, 'Streetname 1 bus D, 9123 Gent', '1', 'D'),
            $locality,
            $streetName,
            $position
        );

        $this->assertEquals(new AddressId(100), $details->addressId());
        $this->assertSame($locality, $details->locality());
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
        $address = $this->createAddress(100, 'Streetname 1 bus D, 9123 Gent', '1', 'D');
        $locality = $this->createLocality(200, 'Gent', 9000);
        $streetName = $this->createStreetName(300, 'Street name');
        $position = $this->createPosition(10123, 200123);

        $details = new AddressDetail($address, $locality, $streetName, $position);

        $otherDetails = new AddressDetail(
            $this->createAddress(101, 'Streetname 1 bus D, 9123 Gent', '1', 'D'),
            $locality,
            $streetName,
            $position
        );

        $this->assertFalse($details->sameValueAs($otherDetails));
    }

    /**
     * Not the same value if the locality object is not identical.
     *
     * @test
     */
    public function notSameIfLocalityIsNotIdentical(): void
    {
        $address = $this->createAddress(100, 'Streetname 1 bus D, 9123 Gent', '1', 'D');
        $locality = $this->createLocality(200, 'Gent', 9000);
        $streetName = $this->createStreetName(300, 'Street name');
        $position = $this->createPosition(10123, 200123);

        $details = new AddressDetail($address, $locality, $streetName, $position);

        $otherDetails = new AddressDetail(
            $address,
            $this->createLocality(201, 'Gent', 9123),
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
        $address = $this->createAddress(100, 'Streetname 1 bus D, 9123 Gent', '1', 'D');
        $locality = $this->createLocality(200, 'Gent', 9000);
        $streetName = $this->createStreetName(300, 'Street name');
        $position = $this->createPosition(10123, 200123);

        $details = new AddressDetail($address, $locality, $streetName, $position);

        $otherDetails = new AddressDetail(
            $address,
            $locality,
            $this->createStreetName(301, 'Street name'),
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
        $address = $this->createAddress(100, 'Streetname 1 bus D, 9123 Gent', '1', 'D');
        $locality = $this->createLocality(200, 'Gent', 9000);
        $streetName = $this->createStreetName(300, 'Street name');
        $position = $this->createPosition(10123, 200123);

        $details = new AddressDetail($address, $locality, $streetName, $position);

        $otherDetails = new AddressDetail(
            $address,
            $locality,
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
        $address = $this->createAddress(100, 'Streetname 1 bus D, 9123 Gent', '1', 'D');
        $locality = $this->createLocality(200, 'Gent', 9000);
        $streetName = $this->createStreetName(300, 'Street name');
        $position = $this->createPosition(10123, 200123);

        $details = new AddressDetail($address, $locality, $streetName, $position);
        $otherDetails = new AddressDetail(
            $address,
            $locality,
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
        $address = $this->createAddress(100, 'Streetname 1 bus D, 9123 Gent', '1', 'D');
        $locality = $this->createLocality(200, 'Gent', 9000);
        $streetName = $this->createStreetName(300, 'Street name');
        $position = $this->createPosition(10123, 200123);

        $details = new AddressDetail($address, $locality, $streetName, $position);

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
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\Address
     */
    private function createAddress(
        int $identitifier,
        string $fullAddress,
        string $houseNumber,
        string $busNumber
    ): Address {
        $addressId = new AddressId($identitifier);
        $fullAddress = new FullAddress(
            new GeographicalName(
                new LanguageCode('NL'),
                $fullAddress
            )
        );

        return new Address($addressId, $houseNumber, $busNumber, $fullAddress);
    }

    /**
     * Create a locality object.
     *
     * @param int $identifier
     * @param string $name
     * @param int $postInfoIdentifier
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\Locality\Locality
     */
    private function createLocality(int $identifier, string $name, int $postInfoIdentifier): Locality
    {
        return new Locality(
            new PostInfoId($postInfoIdentifier),
            new LocalityName(
                new LocalityNameId($identifier),
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
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\StreetName
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
