<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Value\Street;

use DigipolisGent\Flanders\BasicRegisters\Value\GeographicalName;
use DigipolisGent\Flanders\BasicRegisters\Value\LanguageCode;
use DigipolisGent\Flanders\BasicRegisters\Value\Street\StreetName;
use DigipolisGent\Flanders\BasicRegisters\Value\Street\StreetNameId;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Value\AbstractWithGeographicalName
 * @covers \DigipolisGent\Flanders\BasicRegisters\Value\Street\StreetName
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
        $geographicalName = new GeographicalName(new LanguageCode('NL'), 'Foo');

        $streetName = new StreetName($streetNameId, $geographicalName);

        $this->assertSame($streetNameId, $streetName->streetNameId());
        $this->assertSame($geographicalName, $streetName->geographicalName());
    }

    /**
     * The name is extracted from the geographical name.
     *
     * @test
     */
    public function nameIsExtractedFromGeographicalName(): void
    {
        $streetNameId = new StreetNameId(123);
        $geographicalName = new GeographicalName(new LanguageCode('NL'), 'Foo');

        $streetName = new StreetName($streetNameId, $geographicalName);

        $this->assertSame($geographicalName->spelling(), $streetName->name());
    }

    /**
     * Not the same value if the object id is different.
     *
     * @test
     */
    public function notSameIfStreetNameIdIsDifferent(): void
    {
        $streetNameId = new StreetNameId(123);
        $geographicalName = new GeographicalName(new LanguageCode('NL'), 'Foo');

        $streetName = new StreetName($streetNameId, $geographicalName);
        $otherStreetName = new StreetName(
            new StreetNameId(456),
            $geographicalName
        );

        $this->assertFalse($streetName->sameValueAs($otherStreetName));
    }

    /**
     * Not the same value if the geographical name is different.
     *
     * @test
     */
    public function notSameIfGeographicalNameIsDifferent(): void
    {
        $streetNameId = new StreetNameId(123);
        $geographicalName = new GeographicalName(new LanguageCode('EN'), 'Foo ');

        $streetName = new StreetName($streetNameId, $geographicalName);
        $otherStreetName = new StreetName(
            $streetNameId,
            new GeographicalName(new LanguageCode('EN'), 'Biz ')
        );

        $this->assertFalse($streetName->sameValueAs($otherStreetName));
    }

    /**
     * Same values if details are identical.
     *
     * @test
     */
    public function sameIfDetailsAreIdentical(): void
    {
        $streetNameId = new StreetNameId(123);
        $geographicalName = new GeographicalName(new LanguageCode('EN'), 'Foo');

        $streetName = new StreetName($streetNameId, $geographicalName);
        $sameStreetName = new StreetName($streetNameId, $geographicalName);

        $this->assertTrue($streetName->sameValueAs($sameStreetName));
    }

    /**
     * Casting to string returns spelling value from GeographicalName.
     *
     * @test
     */
    public function castToStringReturnsPostalCodeAndName(): void
    {
        $streetNameId = new StreetNameId(123);
        $geographicalName = new GeographicalName(new LanguageCode('EN'), 'Foo EN');

        $streetName = new StreetName($streetNameId, $geographicalName);

        $this->assertSame($geographicalName->spelling(), (string) $streetName);
    }
}
