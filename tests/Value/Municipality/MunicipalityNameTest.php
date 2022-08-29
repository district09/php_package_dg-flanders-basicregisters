<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Value\Municipality;

use DigipolisGent\Flanders\BasicRegisters\Value\Geographical\GeographicalName;
use DigipolisGent\Flanders\BasicRegisters\Value\LanguageCode;
use DigipolisGent\Flanders\BasicRegisters\Value\Municipality\MunicipalityName;
use DigipolisGent\Flanders\BasicRegisters\Value\Municipality\MunicipalityNameId;
use DigipolisGent\Tests\Flanders\BasicRegisters\TestCase;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Value\Municipality\MunicipalityName
 */
class MunicipalityNameTest extends TestCase
{
    /**
     * Municipality name is created from its object id and geographical name.
     *
     * @test
     */
    public function valueIsCreatedFromItsDetails(): void
    {
        $municipalityNameId = new MunicipalityNameId(123);
        $geographicalName = new GeographicalName(new LanguageCode('NL'), 'Gent');

        $municipalityName = new MunicipalityName($municipalityNameId, $geographicalName);

        $this->assertSame($municipalityNameId, $municipalityName->municipalityNameId());
        $this->assertSame($geographicalName, $municipalityName->geographicalName());
    }

    /**
     * Not the same value if the municipality name id is different.
     *
     * @test
     */
    public function notSameIfMunicipalityNameIdIsDifferent(): void
    {
        $municipalityNameId = new MunicipalityNameId(123);
        $geographicalName = new GeographicalName(new LanguageCode('EN'), 'Gent');

        $municipalityName = new MunicipalityName($municipalityNameId, $geographicalName);

        $otherMunicipalityName = new MunicipalityName(
            new MunicipalityNameId(456),
            $geographicalName
        );

        $this->assertFalse($municipalityName->sameValueAs($otherMunicipalityName));
    }

    /**
     * Same values if all details are identical.
     *
     * @test
     */
    public function sameIfAllDetailsAreIdentical(): void
    {
        $municipalityNameId = new MunicipalityNameId(123);
        $geographicalName = new GeographicalName(new LanguageCode('EN'), 'Gent');

        $municipalityName = new MunicipalityName($municipalityNameId, $geographicalName);
        $sameMunicipalityName = new MunicipalityName($municipalityNameId, $geographicalName);

        $this->assertTrue($municipalityName->sameValueAs($sameMunicipalityName));
    }
}
