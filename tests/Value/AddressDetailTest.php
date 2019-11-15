<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Value;

use DigipolisGent\Flanders\BasicRegisters\Value\Address;
use DigipolisGent\Flanders\BasicRegisters\Value\AddressDetail;
use DigipolisGent\Flanders\BasicRegisters\Value\FullAddress;
use DigipolisGent\Flanders\BasicRegisters\Value\GeographicalName;
use DigipolisGent\Flanders\BasicRegisters\Value\GeographicalNames;
use DigipolisGent\Flanders\BasicRegisters\Value\LanguageCode;
use DigipolisGent\Flanders\BasicRegisters\Value\Locality;
use DigipolisGent\Flanders\BasicRegisters\Value\ObjectId;
use DigipolisGent\Flanders\BasicRegisters\Value\Position\Lambert72Point;
use DigipolisGent\Flanders\BasicRegisters\Value\Position\PointInterface;
use DigipolisGent\Flanders\BasicRegisters\Value\StreetName;
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
        $locality = $this->createLocality(200, 'Locality');
        $postInfoId = $this->createPostInfoId(9123);
        $streetName = $this->createStreetName(300, 'Street name');
        $position = $this->createPosition(10123, 200123);

        $details = new AddressDetail(
            $this->createAddress(100, 'Streetname 1 bus D, 9123 Locality', '1', 'D'),
            $locality,
            $postInfoId,
            $streetName,
            $position
        );

        $this->assertEquals(new ObjectId(100), $details->objectId());
        $this->assertSame($locality, $details->locality());
        $this->assertSame(9123, $details->postalCode());
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
        $address = $this->createAddress(100, 'Streetname 1 bus D, 9123 Locality', '1', 'D');
        $locality = $this->createLocality(200, 'Locality');
        $postInfoId = $this->createPostInfoId(9123);
        $streetName = $this->createStreetName(300, 'Street name');
        $position = $this->createPosition(10123, 200123);

        $details = new AddressDetail($address, $locality, $postInfoId, $streetName, $position);

        $otherDetails = new AddressDetail(
            $this->createAddress(101, 'Streetname 1 bus D, 9123 Locality', '1', 'D'),
            $locality,
            $postInfoId,
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
        $address = $this->createAddress(100, 'Streetname 1 bus D, 9123 Locality', '1', 'D');
        $locality = $this->createLocality(200, 'Locality');
        $postInfoId = $this->createPostInfoId(9123);
        $streetName = $this->createStreetName(300, 'Street name');
        $position = $this->createPosition(10123, 200123);

        $details = new AddressDetail($address, $locality, $postInfoId, $streetName, $position);

        $otherDetails = new AddressDetail(
            $address,
            $this->createLocality(201, 'Locality'),
            $postInfoId,
            $streetName,
            $position
        );

        $this->assertFalse($details->sameValueAs($otherDetails));
    }

    /**
     * Not the same value if the post info id is not identical.
     *
     * @test
     */
    public function notSameIfPostInfoIdIsNotIdentical(): void
    {
        $address = $this->createAddress(100, 'Streetname 1 bus D, 9123 Locality', '1', 'D');
        $locality = $this->createLocality(200, 'Locality');
        $postInfoId = $this->createPostInfoId(9123);
        $streetName = $this->createStreetName(300, 'Street name');
        $position = $this->createPosition(10123, 200123);

        $details = new AddressDetail($address, $locality, $postInfoId, $streetName, $position);

        $otherDetails = new AddressDetail(
            $address,
            $locality,
            $this->createPostInfoId(9000),
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
        $address = $this->createAddress(100, 'Streetname 1 bus D, 9123 Locality', '1', 'D');
        $locality = $this->createLocality(200, 'Locality');
        $postInfoId = $this->createPostInfoId(9123);
        $streetName = $this->createStreetName(300, 'Street name');
        $position = $this->createPosition(10123, 200123);

        $details = new AddressDetail($address, $locality, $postInfoId, $streetName, $position);

        $otherDetails = new AddressDetail(
            $address,
            $locality,
            $postInfoId,
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
        $address = $this->createAddress(100, 'Streetname 1 bus D, 9123 Locality', '1', 'D');
        $locality = $this->createLocality(200, 'Locality');
        $postInfoId = $this->createPostInfoId(9123);
        $streetName = $this->createStreetName(300, 'Street name');
        $position = $this->createPosition(10123, 200123);

        $details = new AddressDetail($address, $locality, $postInfoId, $streetName, $position);

        $otherDetails = new AddressDetail(
            $address,
            $locality,
            $postInfoId,
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
        $address = $this->createAddress(100, 'Streetname 1 bus D, 9123 Locality', '1', 'D');
        $locality = $this->createLocality(200, 'Locality');
        $postInfoId = $this->createPostInfoId(9123);
        $streetName = $this->createStreetName(300, 'Street name');
        $position = $this->createPosition(10123, 200123);

        $details = new AddressDetail($address, $locality, $postInfoId, $streetName, $position);
        $otherDetails = new AddressDetail(
            $address,
            $locality,
            $postInfoId,
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
        $address = $this->createAddress(100, 'Streetname 1 bus D, 9123 Locality', '1', 'D');
        $locality = $this->createLocality(200, 'Locality');
        $postInfoId = $this->createPostInfoId(9123);
        $streetName = $this->createStreetName(300, 'Street name');
        $position = $this->createPosition(10123, 200123);

        $details = new AddressDetail($address, $locality, $postInfoId, $streetName, $position);

        $this->assertSame((string) $address, (string) $details);
    }

    /**
     * Create address object.
     *
     * @param int $objectId
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
        $objectId = new ObjectId($identitifier);
        $fullAddress = new FullAddress(
            new GeographicalName(
                new LanguageCode('NL'),
                $fullAddress
            )
        );

        return new Address($objectId, $houseNumber, $busNumber, $fullAddress);
    }

    /**
     * Create a locality object.
     *
     * @param int $objectId
     * @param string $name
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\Locality
     */
    private function createLocality(int $objectId, string $name): Locality
    {
        return new Locality(
            new ObjectId($objectId),
            new GeographicalNames(
                new GeographicalName(
                    new LanguageCode('NL'),
                    $name
                )
            )
        );
    }

    /**
     * Create a post info object id.
     *
     * @param int $identifier
     *
     * @return ObjectId
     */
    private function createPostInfoId(int $identifier): ObjectId
    {
        return new ObjectId($identifier);
    }

    /**
     * Create street name object.
     *
     * @param int $objectId
     * @param string $name
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\StreetName
     */
    private function createStreetName(int $objectId, string $name): StreetName
    {
        return new StreetName(
            new ObjectId($objectId),
            new GeographicalNames(
                new GeographicalName(
                    new LanguageCode('NL'),
                    $name
                )
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
