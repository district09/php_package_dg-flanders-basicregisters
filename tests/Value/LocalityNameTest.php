<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Value;

use DigipolisGent\Flanders\BasicRegisters\Value\GeographicalName;
use DigipolisGent\Flanders\BasicRegisters\Value\LanguageCode;
use DigipolisGent\Flanders\BasicRegisters\Value\LocalityName;
use DigipolisGent\Flanders\BasicRegisters\Value\LocalityNameId;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Value\LocalityName
 */
class LocalityNameTest extends TestCase
{

    /**
     * Locality name is created from its object id and geographical name.
     *
     * @test
     */
    public function valueIsCreatedFromItsDetails(): void
    {
        $localityNameId = new LocalityNameId(123);
        $geographicalName = new GeographicalName(new LanguageCode('NL'), 'Gent');

        $localityName = new LocalityName($localityNameId, $geographicalName);

        $this->assertSame($localityNameId, $localityName->localityNameId());
        $this->assertSame($geographicalName, $localityName->geographicalName());
    }

    /**
     * Not the same value if the locality name id is different.
     *
     * @test
     */
    public function notSameIfLocalityNameIdIsDifferent(): void
    {
        $localityNameId = new LocalityNameId(123);
        $geographicalName = new GeographicalName(new LanguageCode('EN'), 'Gent');

        $localityName = new LocalityName($localityNameId, $geographicalName);

        $otherLocalityName = new LocalityName(
            new LocalityNameId(456),
            $geographicalName
        );

        $this->assertFalse($localityName->sameValueAs($otherLocalityName));
    }

    /**
     * Same values if all details are identical.
     *
     * @test
     */
    public function sameIfAllDetailsAreIdentical(): void
    {
        $localityNameId = new LocalityNameId(123);
        $geographicalName = new GeographicalName(new LanguageCode('EN'), 'Gent');

        $localityName = new LocalityName($localityNameId, $geographicalName);
        $sameLocalityName = new LocalityName($localityNameId, $geographicalName);

        $this->assertTrue($localityName->sameValueAs($sameLocalityName));
    }
}
