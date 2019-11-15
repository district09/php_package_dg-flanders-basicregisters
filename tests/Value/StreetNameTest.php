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
 * @covers \DigipolisGent\Flanders\BasicRegisters\Value\StreetName
 */
class StreetNameTest extends TestCase
{

    /**
     * Street name is created from its object id and geographical names.
     *
     * @test
     */
    public function createdFromObjectIdAndGeographicalNames(): void
    {
        $streetNameId = new StreetNameId(123);
        $geographicalNames = new GeographicalNames(
            new GeographicalName(new LanguageCode('NL'), 'Foo Nl')
        );

        $locality = new StreetName($streetNameId, $geographicalNames);

        $this->assertSame($streetNameId, $locality->streetNameId());
        $this->assertSame($geographicalNames, $locality->geographicalNames());
    }

    /**
     * Not the same value if the object id is different.
     *
     * @test
     */
    public function notSameIfObjectIdIsDifferent(): void
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
}
