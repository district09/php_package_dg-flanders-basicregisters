<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Value\Municipality;

use DigipolisGent\Flanders\BasicRegisters\Value\Geographical\GeographicalName;
use DigipolisGent\Flanders\BasicRegisters\Value\Geographical\GeographicalNames;
use DigipolisGent\Flanders\BasicRegisters\Value\LanguageCode;
use DigipolisGent\Flanders\BasicRegisters\Value\Municipality\MunicipalityNameDetail;
use DigipolisGent\Flanders\BasicRegisters\Value\Municipality\MunicipalityNameId;
use DigipolisGent\Tests\Flanders\BasicRegisters\TestCase;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Value\Municipality\MunicipalityNameDetail
 */
class MunicipalityNameDetailTest extends TestCase
{
    /**
     * Municipality name detail is created from its object id and geographical names.
     *
     * @test
     */
    public function valueIsCreatedFromItsDetails(): void
    {
        $municipalityNameId = new MunicipalityNameId(123);
        $geographicalNames = new GeographicalNames(
            new GeographicalName(new LanguageCode('NL'), 'Gent')
        );

        $municipalityNameDetail = new MunicipalityNameDetail($municipalityNameId, $geographicalNames);

        $this->assertSame($municipalityNameId, $municipalityNameDetail->municipalityNameId());
        $this->assertSame($geographicalNames, $municipalityNameDetail->geographicalNames());
    }

    /**
     * Not the same value if the municipality name id is different.
     *
     * @test
     */
    public function notSameIfMunicipalityNameIdIsDifferent(): void
    {
        $municipalityNameId = new MunicipalityNameId(123);
        $geographicalNames = new GeographicalNames(
            new GeographicalName(new LanguageCode('NL'), 'Gent')
        );

        $municipalityNameDetail = new MunicipalityNameDetail($municipalityNameId, $geographicalNames);

        $otherMunicipalityNameDetail = new MunicipalityNameDetail(
            new MunicipalityNameId(456),
            $geographicalNames
        );

        $this->assertFalse($municipalityNameDetail->sameValueAs($otherMunicipalityNameDetail));
    }

    /**
     * Same values if all details are identical.
     *
     * @test
     */
    public function sameIfAllDetailsAreIdentical(): void
    {
        $municipalityNameId = new MunicipalityNameId(123);
        $geographicalNames = new GeographicalNames(
            new GeographicalName(new LanguageCode('NL'), 'Gent')
        );

        $municipalityNameDetail = new MunicipalityNameDetail($municipalityNameId, $geographicalNames);
        $sameMunicipalityNameDetail = new MunicipalityNameDetail($municipalityNameId, $geographicalNames);

        $this->assertTrue($municipalityNameDetail->sameValueAs($sameMunicipalityNameDetail));
    }
}
