<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Value;

use DigipolisGent\Flanders\BasicRegisters\Value\GeographicalName;
use DigipolisGent\Flanders\BasicRegisters\Value\GeographicalNames;
use DigipolisGent\Flanders\BasicRegisters\Value\LanguageCode;
use DigipolisGent\Flanders\BasicRegisters\Value\Locality\LocalityName;
use DigipolisGent\Flanders\BasicRegisters\Value\Locality\LocalityNameId;
use DigipolisGent\Flanders\BasicRegisters\Value\StreetNameDetail;
use DigipolisGent\Flanders\BasicRegisters\Value\StreetNameId;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Value\AbstractWithGeographicalNames
 * @covers \DigipolisGent\Flanders\BasicRegisters\Value\StreetNameDetail
 */
class StreetNameDetailTest extends TestCase
{

    /**
     * Value is created from its details.
     *
     * @test
     */
    public function valueIsCreatedFromItsDetails(): void
    {
        $streetNameId = new StreetNameId(123);
        $geographicalNames = new GeographicalNames(
            new GeographicalName(new LanguageCode('NL'), 'Foo Nl')
        );
        $localityName = $this->createLocalityName(100);

        $streetNameDetail = new StreetNameDetail($streetNameId, $geographicalNames, $localityName);

        $this->assertSame($streetNameId, $streetNameDetail->streetNameId());
        $this->assertSame($geographicalNames, $streetNameDetail->geographicalNames());
        $this->assertSame($localityName, $streetNameDetail->localityName());
    }

    /**
     * The name is extracted from the geographical names.
     *
     * @test
     */
    public function nameIsExtractedFromGeographicalNames(): void
    {
        $streetNameId = new StreetNameId(123);
        $geographicalNames = new GeographicalNames(
            new GeographicalName(new LanguageCode('NL'), 'Foo Nl')
        );
        $localityName = $this->createLocalityName(100);

        $streetNameDetail = new StreetNameDetail($streetNameId, $geographicalNames, $localityName);

        $this->assertSame($geographicalNames->name(), $streetNameDetail->name());
    }

    /**
     * Not the same value if the object id is different.
     *
     * @test
     */
    public function notSameIfStreetNameIdIsDifferent(): void
    {
        $streetNameId = new StreetNameId(123);
        $geographicalNames = new GeographicalNames(
            new GeographicalName(new LanguageCode('EN'), 'Foo EN')
        );
        $localityName = $this->createLocalityName(100);

        $streetNameDetail = new StreetNameDetail($streetNameId, $geographicalNames, $localityName);

        $otherStreetNameDetail = new StreetNameDetail(
            new StreetNameId(456),
            $geographicalNames,
            $localityName
        );

        $this->assertFalse($streetNameDetail->sameValueAs($otherStreetNameDetail));
    }

    /**
     * Not the same value if the geographical names are different.
     *
     * @test
     */
    public function notSameIfGeographicalNamesAreDifferent(): void
    {
        $streetNameId = new StreetNameId(123);
        $geographicalNames = new GeographicalNames(
            new GeographicalName(new LanguageCode('EN'), 'Foo EN')
        );
        $localityName = $this->createLocalityName(100);

        $streetNameDetail = new StreetNameDetail($streetNameId, $geographicalNames, $localityName);

        $otherGeographicalNames = new GeographicalNames(
            new GeographicalName(new LanguageCode('NL'), 'Foo NL')
        );
        $otherStreetNameDetail = new StreetNameDetail($streetNameId, $otherGeographicalNames, $localityName);

        $this->assertFalse($streetNameDetail->sameValueAs($otherStreetNameDetail));
    }

    /**
     * Not the same value if the locality name is different.
     *
     * @test
     */
    public function notSameIfLocalityNameIsDifferent(): void
    {
        $streetNameId = new StreetNameId(123);
        $geographicalNames = new GeographicalNames(
            new GeographicalName(new LanguageCode('EN'), 'Foo EN')
        );
        $localityName = $this->createLocalityName(100);

        $streetNameDetail = new StreetNameDetail($streetNameId, $geographicalNames, $localityName);

        $otherStreetNameDetail = new StreetNameDetail(
            $streetNameId,
            $geographicalNames,
            $this->createLocalityName(200)
        );

        $this->assertFalse($streetNameDetail->sameValueAs($otherStreetNameDetail));
    }

    /**
     * Same values if object id and geographical names are identical.
     *
     * @test
     */
    public function sameIfDetailsAreIdentical(): void
    {
        $streetNameId = new StreetNameId(123);
        $geographicalNames = new GeographicalNames(
            new GeographicalName(new LanguageCode('EN'), 'Foo EN')
        );
        $localityName = $this->createLocalityName(100);

        $streetNameDetail = new StreetNameDetail($streetNameId, $geographicalNames, $localityName);
        $sameStreetNameDetail = new StreetNameDetail($streetNameId, $geographicalNames, $localityName);

        $this->assertTrue($streetNameDetail->sameValueAs($sameStreetNameDetail));
    }

    /**
     * Casting to string returns name from GeographicalNames collection.
     *
     * @test
     */
    public function castToStringReturnsPostalCodeAndName(): void
    {
        $streetNameId = new StreetNameId(123);
        $geographicalNames = new GeographicalNames(
            new GeographicalName(new LanguageCode('EN'), 'Foo EN')
        );
        $localityName = $this->createLocalityName(100);

        $streetNameDetail = new StreetNameDetail($streetNameId, $geographicalNames, $localityName);

        $this->assertSame($geographicalNames->name(), (string) $streetNameDetail);
    }

    /**
     * Create a locality name.
     *
     * @param int $identifier
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\Locality\LocalityName
     */
    private function createLocalityName(int $identifier): LocalityName
    {
        return new LocalityName(
            new LocalityNameId($identifier),
            new GeographicalName(
                new LanguageCode('NL'),
                'Gent'
            )
        );
    }
}
