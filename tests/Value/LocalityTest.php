<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Value;

use DigipolisGent\Flanders\BasicRegisters\Value\GeographicalName;
use DigipolisGent\Flanders\BasicRegisters\Value\GeographicalNames;
use DigipolisGent\Flanders\BasicRegisters\Value\LanguageCode;
use DigipolisGent\Flanders\BasicRegisters\Value\Locality;
use DigipolisGent\Flanders\BasicRegisters\Value\LocalityId;
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
        $localityId = new LocalityId(123);
        $geographicalNames = new GeographicalNames(
            new GeographicalName(new LanguageCode('NL'), 'Foo Nl')
        );

        $locality = new Locality($localityId, $geographicalNames);

        $this->assertSame($localityId, $locality->localityId());
        $this->assertSame($geographicalNames, $locality->geographicalNames());
    }

    /**
     * The name is extracted from the geographical names.
     *
     * @test
     */
    public function nameIsExtractedFromGeographicalNames(): void
    {
        $localityId = new LocalityId(123);
        $geographicalNames = new GeographicalNames(
            new GeographicalName(new LanguageCode('EN'), 'Foo EN'),
            new GeographicalName(new LanguageCode('NL'), 'Foo Nl')
        );

        $locality = new Locality($localityId, $geographicalNames);

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

        $localityId = new LocalityId(123);
        $locality = new Locality($localityId, $geographicalNames);

        $otherLocalityId = new LocalityId(456);
        $otherLocality = new Locality($otherLocalityId, $geographicalNames);

        $this->assertFalse($locality->sameValueAs($otherLocality));
    }

    /**
     * Not the same value if the geographical names are different.
     *
     * @test
     */
    public function notSameIfGeographicalNamesAreDifferent(): void
    {
        $localityId = new LocalityId(123);

        $geographicalNames = new GeographicalNames(
            new GeographicalName(new LanguageCode('EN'), 'Foo EN')
        );
        $locality = new Locality($localityId, $geographicalNames);

        $otherGeographicalNames = new GeographicalNames(
            new GeographicalName(new LanguageCode('NL'), 'Foo NL')
        );
        $otherLocality = new Locality($localityId, $otherGeographicalNames);

        $this->assertFalse($locality->sameValueAs($otherLocality));
    }

    /**
     * Same values if object id and geographical names are identical.
     *
     * @test
     */
    public function sameIfObjectIdAndGeographicalNamesAreIdentical(): void
    {
        $localityId = new LocalityId(123);
        $geographicalNames = new GeographicalNames(
            new GeographicalName(new LanguageCode('EN'), 'Foo EN')
        );

        $locality = new Locality($localityId, $geographicalNames);
        $sameLocality = new Locality($localityId, $geographicalNames);

        $this->assertTrue($locality->sameValueAs($sameLocality));
    }

    /**
     * Casting to string returns same value as name() method.
     *
     * @test
     */
    public function castToStringReturnsNameMethodValue(): void
    {
        $localityId = new LocalityId(123);
        $geographicalNames = new GeographicalNames(
            new GeographicalName(new LanguageCode('EN'), 'Foo EN')
        );
        $locality = new Locality($localityId, $geographicalNames);

        $this->assertSame($locality->name(), (string) $locality);
    }
}
