<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Value\Address\Address;

use DigipolisGent\Flanders\BasicRegisters\Value\Address\AddressDetailInterface;
use DigipolisGent\Flanders\BasicRegisters\Value\Address\AddressId;
use DigipolisGent\Flanders\BasicRegisters\Value\Address\AddressMatch;
use DigipolisGent\Flanders\BasicRegisters\Value\Geographical\GeographicalName;
use DigipolisGent\Flanders\BasicRegisters\Value\LanguageCode;
use DigipolisGent\Flanders\BasicRegisters\Value\Locality\LocalityName;
use DigipolisGent\Flanders\BasicRegisters\Value\Locality\LocalityNameId;
use DigipolisGent\Flanders\BasicRegisters\Value\Street\StreetName;
use DigipolisGent\Flanders\BasicRegisters\Value\Street\StreetNameId;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Value\Address\AddressMatch
 */
class AddressMatchTest extends TestCase
{
    /**
     * Value is created from its details.
     *
     * @test
     */
    public function valueIsCreatedFromAllItsDetails(): void
    {
        $localityName = $this->createLocalityName(123, 'Gent');
        $streetName = $this->createStreetName(456, 'Bellevue');
        $addressDetail = $this->createAddressDetailMock(100);
        $addressMatch = new AddressMatch($localityName, $streetName, $addressDetail, 98.123456);

        $this->assertSame($localityName, $addressMatch->localityName());
        $this->assertSame($streetName, $addressMatch->streetName());
        $this->assertTrue($addressMatch->hasAddressDetail());
        $this->assertSame($addressDetail, $addressMatch->addressDetail());
        $this->assertSame(98.123456, $addressMatch->score());
    }

    /**
     * Value can be created without address details.
     *
     * @test
     */
    public function valueCanBeCreatedWithoutAddressDetail(): void
    {
        $localityName = $this->createLocalityName(123, 'Gent');
        $streetName = $this->createStreetName(456, 'Bellevue');
        $addressDetail = null;
        $addressMatch = new AddressMatch($localityName, $streetName, $addressDetail, 98.123456);

        $this->assertSame($localityName, $addressMatch->localityName());
        $this->assertSame($streetName, $addressMatch->streetName());
        $this->assertFalse($addressMatch->hasAddressDetail());
        $this->assertNull($addressMatch->addressDetail());
        $this->assertSame(98.123456, $addressMatch->score());
    }

    /**
     * Not same if the locality name is different.
     *
     * @test
     */
    public function notSameIfLocalityNameIsDifferent(): void
    {
        $localityName = $this->createLocalityName(123, 'Gent');
        $streetName = $this->createStreetName(456, 'Bellevue');
        $addressDetail = null;
        $addressMatch = new AddressMatch($localityName, $streetName, $addressDetail, 100);

        $otherAddressMatch = new AddressMatch(
            $this->createLocalityName(321, 'Foo'),
            $streetName,
            $addressDetail,
            100
        );

        $this->assertFalse($addressMatch->sameValueAs($otherAddressMatch));
    }

    /**
     * Not same if the street names is different.
     *
     * @test
     */
    public function notSameIfStreetNameIsDifferent(): void
    {
        $localityName = $this->createLocalityName(123, 'Gent');
        $streetName = $this->createStreetName(456, 'Bellevue');
        $addressDetail = null;
        $addressMatch = new AddressMatch($localityName, $streetName, $addressDetail, 100);

        $otherAddressMatch = new AddressMatch(
            $localityName,
            $this->createStreetName(654, 'Foo'),
            $addressDetail,
            100
        );

        $this->assertFalse($addressMatch->sameValueAs($otherAddressMatch));
    }

    /**
     * Not same if only the match has address details.
     *
     * @test
     */
    public function notSameIfOnlyMatchHasAddressDetails(): void
    {
        $localityName = $this->createLocalityName(123, 'Gent');
        $streetName = $this->createStreetName(456, 'Bellevue');
        $addressDetail = $this->createAddressDetailMock(789);
        $addressMatch = new AddressMatch($localityName, $streetName, $addressDetail, 100);

        $otherAddressMatch = new AddressMatch(
            $localityName,
            $streetName,
            null,
            100
        );

        $this->assertFalse($addressMatch->sameValueAs($otherAddressMatch));
    }

    /**
     * Not same if only the other match has address details.
     *
     * @test
     */
    public function notSameIfOnlyOtherMatchHasAddressDetails(): void
    {
        $localityName = $this->createLocalityName(123, 'Gent');
        $streetName = $this->createStreetName(456, 'Bellevue');
        $addressDetail = null;
        $addressMatch = new AddressMatch($localityName, $streetName, $addressDetail, 100);

        $otherAddressMatch = new AddressMatch(
            $localityName,
            $streetName,
            $this->createAddressDetailMock(987),
            100
        );

        $this->assertFalse($addressMatch->sameValueAs($otherAddressMatch));
    }

    /**
     * Not same if only the other match has address details.
     *
     * @test
     */
    public function notSameIfAddressDetailsIsDifferent(): void
    {
        $localityName = $this->createLocalityName(123, 'Gent');
        $streetName = $this->createStreetName(456, 'Bellevue');
        $addressDetail = $this->prophesize(AddressDetailInterface::class);
        $addressDetail->sameValueAs(Argument::any())->willReturn(false);
        $addressMatch = new AddressMatch($localityName, $streetName, $addressDetail->reveal(), 100);

        $otherAddressMatch = new AddressMatch(
            $localityName,
            $streetName,
            $this->createAddressDetailMock(987),
            100
        );

        $this->assertFalse($addressMatch->sameValueAs($otherAddressMatch));
    }

    /**
     * Same if both details are identical and both have no address details.
     *
     * @test
     */
    public function sameIfBothHaveIdenticalDetailsAndNoAddressDetails(): void
    {
        $localityName = $this->createLocalityName(123, 'Gent');
        $streetName = $this->createStreetName(456, 'Bellevue');
        $addressDetail = null;
        $addressMatch = new AddressMatch($localityName, $streetName, $addressDetail, 100);
        $sameAddressMatch = new AddressMatch($localityName, $streetName, $addressDetail, 100);

        $this->assertTrue($addressMatch->sameValueAs($sameAddressMatch));
    }

    /**
     * Same if both details are identical and both have address details.
     *
     * @test
     */
    public function sameIfBothHaveIdenticalDetailsAndAddressDetails(): void
    {
        $localityName = $this->createLocalityName(123, 'Gent');
        $streetName = $this->createStreetName(456, 'Bellevue');

        $addressDetailMock = $this->prophesize(AddressDetailInterface::class);
        $addressDetailMock->sameValueAs(Argument::any())->willReturn(true);
        $addressDetail = $addressDetailMock->reveal();

        $addressMatch = new AddressMatch($localityName, $streetName, $addressDetail, 100);
        $sameAddressMatch = new AddressMatch($localityName, $streetName, $addressDetail, 100);

        $this->assertTrue($addressMatch->sameValueAs($sameAddressMatch));
    }

    /**
     * Cast to string will return string-casted version of the address detail.
     *
     * @test
     */
    public function castToStringReturnsStringCastOfContractDetail(): void
    {
        $localityName = $this->createLocalityName(123, 'Gent');
        $streetName = $this->createStreetName(456, 'Bellevue');
        $addressDetails = $this->createAddressDetailMock(100);
        $addressMatch = new AddressMatch($localityName, $streetName, $addressDetails, 99);

        $this->assertEquals((string) $addressDetails, (string) $addressMatch);
    }

    /**
     * Cast to string will return [street], [locality] if no address details.
     *
     * @test
     */
    public function castToStringReturnsStreetNameLocalityNameIfNoAddressDetail(): void
    {
        $localityName = $this->createLocalityName(123, 'Gent');
        $streetName = $this->createStreetName(456, 'Bellevue');
        $addressDetails = null;
        $addressMatch = new AddressMatch($localityName, $streetName, $addressDetails, 99);

        $this->assertEquals('Bellevue, Gent', (string) $addressMatch);
    }

    /**
     * Create locality name value.
     *
     * @param int $identifier
     * @param string $name
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\Locality\LocalityName
     */
    private function createLocalityName(int $identifier, string $name): LocalityName
    {
        return new LocalityName(
            new LocalityNameId($identifier),
            new GeographicalName(
                new LanguageCode('NL'),
                $name
            )
        );
    }

    /**
     * Create street name value.
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
     * Create an address detail object.
     *
     * @param int $identifier
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\Address\AddressDetailInterface
     */
    private function createAddressDetailMock(int $identifier): AddressDetailInterface
    {
        $addressDetail = $this->prophesize(AddressDetailInterface::class);
        $addressDetail->addressId()->willReturn(new AddressId($identifier));
        $addressDetail->__toString()->willReturn('Bellevue 1, 9050 Gent');

        return $addressDetail->reveal();
    }
}
