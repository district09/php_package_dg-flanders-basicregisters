<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Value\Street;

use DigipolisGent\Flanders\BasicRegisters\Value\Geographical\GeographicalName;
use DigipolisGent\Flanders\BasicRegisters\Value\Geographical\GeographicalNames;
use DigipolisGent\Flanders\BasicRegisters\Value\LanguageCode;
use DigipolisGent\Flanders\BasicRegisters\Value\Municipality\MunicipalityName;
use DigipolisGent\Flanders\BasicRegisters\Value\Municipality\MunicipalityNameId;
use DigipolisGent\Flanders\BasicRegisters\Value\Street\StreetNameDetail;
use DigipolisGent\Flanders\BasicRegisters\Value\Street\StreetNameId;
use DigipolisGent\Tests\Flanders\BasicRegisters\TestCase;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Value\Geographical\AbstractWithGeographicalNames
 * @covers \DigipolisGent\Flanders\BasicRegisters\Value\Street\StreetNameDetail
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
        $municipalityName = $this->createMunicipalityName(100);

        $streetNameDetail = new StreetNameDetail($streetNameId, $geographicalNames, $municipalityName);

        $this->assertSame($streetNameId, $streetNameDetail->streetNameId());
        $this->assertSame($geographicalNames, $streetNameDetail->geographicalNames());
        $this->assertSame($municipalityName, $streetNameDetail->municipalityName());
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
        $municipalityName = $this->createMunicipalityName(100);

        $streetNameDetail = new StreetNameDetail($streetNameId, $geographicalNames, $municipalityName);

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
        $municipalityName = $this->createMunicipalityName(100);

        $streetNameDetail = new StreetNameDetail($streetNameId, $geographicalNames, $municipalityName);

        $otherStreetNameDetail = new StreetNameDetail(
            new StreetNameId(456),
            $geographicalNames,
            $municipalityName
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
        $municipalityName = $this->createMunicipalityName(100);

        $streetNameDetail = new StreetNameDetail($streetNameId, $geographicalNames, $municipalityName);

        $otherGeographicalNames = new GeographicalNames(
            new GeographicalName(new LanguageCode('NL'), 'Foo NL')
        );
        $otherStreetNameDetail = new StreetNameDetail($streetNameId, $otherGeographicalNames, $municipalityName);

        $this->assertFalse($streetNameDetail->sameValueAs($otherStreetNameDetail));
    }

    /**
     * Not the same value if the municipality name is different.
     *
     * @test
     */
    public function notSameIfMunicipalityNameIsDifferent(): void
    {
        $streetNameId = new StreetNameId(123);
        $geographicalNames = new GeographicalNames(
            new GeographicalName(new LanguageCode('EN'), 'Foo EN')
        );
        $municipalityName = $this->createMunicipalityName(100);

        $streetNameDetail = new StreetNameDetail($streetNameId, $geographicalNames, $municipalityName);

        $otherStreetNameDetail = new StreetNameDetail(
            $streetNameId,
            $geographicalNames,
            $this->createMunicipalityName(200)
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
        $municipalityName = $this->createMunicipalityName(100);

        $streetNameDetail = new StreetNameDetail($streetNameId, $geographicalNames, $municipalityName);
        $sameStreetNameDetail = new StreetNameDetail($streetNameId, $geographicalNames, $municipalityName);

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
        $municipalityName = $this->createMunicipalityName(100);

        $streetNameDetail = new StreetNameDetail($streetNameId, $geographicalNames, $municipalityName);

        $this->assertSame($geographicalNames->name(), (string) $streetNameDetail);
    }

    /**
     * Create a municipality name.
     *
     * @param int $identifier
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\Municipality\MunicipalityName
     */
    private function createMunicipalityName(int $identifier): MunicipalityName
    {
        return new MunicipalityName(
            new MunicipalityNameId($identifier),
            new GeographicalName(
                new LanguageCode('NL'),
                'Gent'
            )
        );
    }
}
