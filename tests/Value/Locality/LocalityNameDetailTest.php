<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Value\Locality;

use DigipolisGent\Flanders\BasicRegisters\Value\Geographical\GeographicalName;
use DigipolisGent\Flanders\BasicRegisters\Value\Geographical\GeographicalNames;
use DigipolisGent\Flanders\BasicRegisters\Value\LanguageCode;
use DigipolisGent\Flanders\BasicRegisters\Value\Locality\LocalityNameDetail;
use DigipolisGent\Flanders\BasicRegisters\Value\Locality\LocalityNameId;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Value\Locality\LocalityNameDetail
 */
class LocalityNameDetailTest extends TestCase
{

    /**
     * Locality name detail is created from its object id and geographical names.
     *
     * @test
     */
    public function valueIsCreatedFromItsDetails(): void
    {
        $localityNameId = new LocalityNameId(123);
        $geographicalNames = new GeographicalNames(
            new GeographicalName(new LanguageCode('NL'), 'Gent')
        );

        $localityNameDetail = new LocalityNameDetail($localityNameId, $geographicalNames);

        $this->assertSame($localityNameId, $localityNameDetail->localityNameId());
        $this->assertSame($geographicalNames, $localityNameDetail->geographicalNames());
    }

    /**
     * Not the same value if the locality name id is different.
     *
     * @test
     */
    public function notSameIfLocalityNameIdIsDifferent(): void
    {
        $localityNameId = new LocalityNameId(123);
        $geographicalNames = new GeographicalNames(
            new GeographicalName(new LanguageCode('NL'), 'Gent')
        );

        $localityNameDetail = new LocalityNameDetail($localityNameId, $geographicalNames);

        $otherLocalityNameDetail = new LocalityNameDetail(
            new LocalityNameId(456),
            $geographicalNames
        );

        $this->assertFalse($localityNameDetail->sameValueAs($otherLocalityNameDetail));
    }

    /**
     * Same values if all details are identical.
     *
     * @test
     */
    public function sameIfAllDetailsAreIdentical(): void
    {
        $localityNameId = new LocalityNameId(123);
        $geographicalNames = new GeographicalNames(
            new GeographicalName(new LanguageCode('NL'), 'Gent')
        );

        $localityNameDetail = new LocalityNameDetail($localityNameId, $geographicalNames);
        $sameLocalityNameDetail = new LocalityNameDetail($localityNameId, $geographicalNames);

        $this->assertTrue($localityNameDetail->sameValueAs($sameLocalityNameDetail));
    }
}
