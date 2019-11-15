<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Value;

use DigipolisGent\Flanders\BasicRegisters\Value\GeographicalName;
use DigipolisGent\Flanders\BasicRegisters\Value\GeographicalNames;
use DigipolisGent\Flanders\BasicRegisters\Value\LanguageCode;
use DigipolisGent\Flanders\BasicRegisters\Value\StreetName;
use DigipolisGent\Flanders\BasicRegisters\Value\StreetNameId;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Value\AbstractWithGeographicalNames
 * @covers \DigipolisGent\Flanders\BasicRegisters\Value\StreetName
 */
class StreetNameTest extends TestCase
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

        $streetName = new StreetName($streetNameId, $geographicalNames);

        $this->assertSame($streetNameId, $streetName->streetNameId());
        $this->assertSame($geographicalNames, $streetName->geographicalNames());
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

        $streetName = new StreetName($streetNameId, $geographicalNames);

        $this->assertSame($geographicalNames->name(), $streetName->name());
    }

    /**
     * Not the same value if the object id is different.
     *
     * @test
     */
    public function notSameIfStreetNameIdIsDifferent(): void
    {
        $geographicalNames = new GeographicalNames(
            new GeographicalName(new LanguageCode('EN'), 'Foo EN')
        );

        $streetNameId = new StreetNameId(123);
        $streetName = new StreetName($streetNameId, $geographicalNames);

        $otherStreetNameId = new StreetNameId(456);
        $otherStreetName = new StreetName($otherStreetNameId, $geographicalNames);

        $this->assertFalse($streetName->sameValueAs($otherStreetName));
    }

    /**
     * Not the same value if the geographical names are different.
     *
     * @test
     */
    public function notSameIfGeographicalNamesAreDifferent(): void
    {
        $geographicalNames = new GeographicalNames(
            new GeographicalName(new LanguageCode('EN'), 'Foo EN')
        );

        $streetNameId = new StreetNameId(123);
        $streetName = new StreetName($streetNameId, $geographicalNames);

        $otherGeographicalNames = new GeographicalNames(
            new GeographicalName(new LanguageCode('NL'), 'Foo NL')
        );
        $otherStreetName = new StreetName($streetNameId, $otherGeographicalNames);

        $this->assertFalse($streetName->sameValueAs($otherStreetName));
    }

    /**
     * Same values if object id and geographical names are identical.
     *
     * @test
     */
    public function sameIfObjectIdAndGeographicalNamesAreIdentical(): void
    {
        $streetNameId = new StreetNameId(123);
        $geographicalNames = new GeographicalNames(
            new GeographicalName(new LanguageCode('EN'), 'Foo EN')
        );

        $streetName = new StreetName($streetNameId, $geographicalNames);
        $sameStreetName = new StreetName($streetNameId, $geographicalNames);

        $this->assertTrue($streetName->sameValueAs($sameStreetName));
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

        $streetName = new StreetName($streetNameId, $geographicalNames);

        $this->assertSame($geographicalNames->name(), (string) $streetName);
    }
}
