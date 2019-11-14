<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Value;

use DigipolisGent\Flanders\BasicRegisters\Value\GeographicalName;
use DigipolisGent\Flanders\BasicRegisters\Value\GeographicalNames;
use DigipolisGent\Flanders\BasicRegisters\Value\LanguageCode;
use DigipolisGent\Flanders\BasicRegisters\Value\Locality;
use DigipolisGent\Flanders\BasicRegisters\Value\ObjectId;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Value\AbstractWithGeographicalNames
 * @covers \DigipolisGent\Flanders\BasicRegisters\Value\Locality
 */
class LocalityTest extends TestCase
{

    /**
     * Locality is created from its object id and geographical names.
     *
     * @test
     */
    public function createdFromObjectIdAndGeographicalNames(): void
    {
        $objectId = new ObjectId(123);
        $geographicalNames = new GeographicalNames(
            new GeographicalName(new LanguageCode('NL'), 'Foo Nl')
        );

        $locality = new Locality($objectId, $geographicalNames);

        $this->assertSame($objectId, $locality->objectId());
        $this->assertSame($geographicalNames, $locality->geographicalNames());
    }

    /**
     * The name is extracted from the geographical names.
     *
     * @test
     */
    public function nameIsExtractedFromGeographicalNames(): void
    {
        $objectId = new ObjectId(123);
        $geographicalNames = new GeographicalNames(
            new GeographicalName(new LanguageCode('EN'), 'Foo EN'),
            new GeographicalName(new LanguageCode('NL'), 'Foo Nl')
        );

        $locality = new Locality($objectId, $geographicalNames);

        $this->assertSame($geographicalNames->name(), $locality->name());
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

        $objectId = new ObjectId(123);
        $locality = new Locality($objectId, $geographicalNames);

        $otherObjectId = new ObjectId(456);
        $otherLocality = new Locality($otherObjectId, $geographicalNames);

        $this->assertFalse($locality->sameValueAs($otherLocality));
    }

    /**
     * Not the same value if the geographical names are different.
     *
     * @test
     */
    public function notSameIfGeographicalNamesAreDifferent(): void
    {
        $objectId = new ObjectId(123);

        $geographicalNames = new GeographicalNames(
            new GeographicalName(new LanguageCode('EN'), 'Foo EN')
        );
        $locality = new Locality($objectId, $geographicalNames);

        $otherGeographicalNames = new GeographicalNames(
            new GeographicalName(new LanguageCode('NL'), 'Foo NL')
        );
        $otherLocality = new Locality($objectId, $otherGeographicalNames);

        $this->assertFalse($locality->sameValueAs($otherLocality));
    }

    /**
     * Same values if object id and geographical names are identical.
     *
     * @test
     */
    public function sameIfObjectIdAndGeographicalNamesAreIdentical(): void
    {
        $objectId = new ObjectId(123);
        $geographicalNames = new GeographicalNames(
            new GeographicalName(new LanguageCode('EN'), 'Foo EN')
        );

        $locality = new Locality($objectId, $geographicalNames);
        $sameLocality = new Locality($objectId, $geographicalNames);

        $this->assertTrue($locality->sameValueAs($sameLocality));
    }

    /**
     * Casting to string returns same value as name() method.
     *
     * @test
     */
    public function castToStringReturnsNameMethodValue(): void
    {
        $objectId = new ObjectId(123);
        $geographicalNames = new GeographicalNames(
            new GeographicalName(new LanguageCode('EN'), 'Foo EN')
        );
        $locality = new Locality($objectId, $geographicalNames);

        $this->assertSame($locality->name(), (string) $locality);
    }
}
