<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Value;

use DigipolisGent\Flanders\BasicRegisters\Value\GeographicalName;
use DigipolisGent\Flanders\BasicRegisters\Value\GeographicalNames;
use DigipolisGent\Flanders\BasicRegisters\Value\LanguageCode;
use DigipolisGent\Flanders\BasicRegisters\Value\Locality;
use DigipolisGent\Flanders\BasicRegisters\Value\LocalityId;
use DigipolisGent\Flanders\BasicRegisters\Value\PostInfoId;
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
        $locality = $this->createLocality(100);

        $streetNameDetail = new StreetNameDetail($streetNameId, $geographicalNames, $locality);

        $this->assertSame($streetNameId, $streetNameDetail->streetNameId());
        $this->assertSame($geographicalNames, $streetNameDetail->geographicalNames());
        $this->assertSame($locality, $streetNameDetail->locality());
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
        $locality = $this->createLocality(100);

        $streetNameDetail = new StreetNameDetail($streetNameId, $geographicalNames, $locality);

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
        $locality = $this->createLocality(100);

        $streetNameDetail = new StreetNameDetail($streetNameId, $geographicalNames, $locality);

        $otherStreetNameDetail = new StreetNameDetail(
            new StreetNameId(456),
            $geographicalNames,
            $locality
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
        $locality = $this->createLocality(100);

        $streetNameDetail = new StreetNameDetail($streetNameId, $geographicalNames, $locality);

        $otherGeographicalNames = new GeographicalNames(
            new GeographicalName(new LanguageCode('NL'), 'Foo NL')
        );
        $otherStreetNameDetail = new StreetNameDetail($streetNameId, $otherGeographicalNames, $locality);

        $this->assertFalse($streetNameDetail->sameValueAs($otherStreetNameDetail));
    }

    /**
     * Not the same value if the locality is different.
     *
     * @test
     */
    public function notSameIfLocalityIsDifferent(): void
    {
        $streetNameId = new StreetNameId(123);
        $geographicalNames = new GeographicalNames(
            new GeographicalName(new LanguageCode('EN'), 'Foo EN')
        );
        $locality = $this->createLocality(100);

        $streetNameDetail = new StreetNameDetail($streetNameId, $geographicalNames, $locality);

        $otherStreetNameDetail = new StreetNameDetail(
            $streetNameId,
            $geographicalNames,
            $this->createLocality(200)
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
        $locality = $this->createLocality(100);

        $streetNameDetail = new StreetNameDetail($streetNameId, $geographicalNames, $locality);
        $sameStreetNameDetail = new StreetNameDetail($streetNameId, $geographicalNames, $locality);

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
        $locality = $this->createLocality(100);

        $streetNameDetail = new StreetNameDetail($streetNameId, $geographicalNames, $locality);

        $this->assertSame($geographicalNames->name(), (string) $streetNameDetail);
    }

    /**
     * Create a locality.
     *
     * @param int $identifier
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\Locality
     */
    private function createLocality(int $identifier): Locality
    {
        return new Locality(
            new LocalityId($identifier),
            new GeographicalNames(
                new GeographicalName(
                    new LanguageCode('NL'),
                    'Locality name'
                )
            ),
            new PostInfoId(9000)
        );
    }
}
