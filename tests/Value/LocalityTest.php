<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Value;

use DigipolisGent\Flanders\BasicRegisters\Value\GeographicalName;
use DigipolisGent\Flanders\BasicRegisters\Value\GeographicalNames;
use DigipolisGent\Flanders\BasicRegisters\Value\LanguageCode;
use DigipolisGent\Flanders\BasicRegisters\Value\Locality;
use DigipolisGent\Flanders\BasicRegisters\Value\LocalityId;
use DigipolisGent\Flanders\BasicRegisters\Value\PostInfoId;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Value\Locality
 */
class LocalityTest extends TestCase
{

    /**
     * Locality is created from its object id and geographical names.
     *
     * @test
     */
    public function valueIsCreatedFromItsDetails(): void
    {
        $localityId = new LocalityId(123);
        $geographicalNames = new GeographicalNames(
            new GeographicalName(new LanguageCode('NL'), 'Foo Nl')
        );
        $postInfoId = new PostInfoId(9000);

        $locality = new Locality($localityId, $geographicalNames, $postInfoId);

        $this->assertSame($localityId, $locality->localityId());
        $this->assertSame($geographicalNames, $locality->geographicalNames());
        $this->assertSame($postInfoId, $locality->postInfoId());
    }

    /**
     * Postal code is extracted from the postInfoId.
     *
     * @test
     */
    public function postalCodeIsExtractedFromPostInfoId(): void
    {
        $localityId = new LocalityId(123);
        $geographicalNames = new GeographicalNames(
            new GeographicalName(new LanguageCode('NL'), 'Foo Nl')
        );
        $postInfoId = new PostInfoId(9000);

        $locality = new Locality($localityId, $geographicalNames, $postInfoId);

        $this->assertSame($postInfoId->value(), $locality->postalCode());
    }

    /**
     * Not the same value if the object id is different.
     *
     * @test
     */
    public function notSameIfLocalityIdIsDifferent(): void
    {
        $localityId = new LocalityId(123);
        $geographicalNames = new GeographicalNames(
            new GeographicalName(new LanguageCode('EN'), 'Foo EN')
        );
        $postInfoId = new PostInfoId(9000);

        $locality = new Locality($localityId, $geographicalNames, $postInfoId);

        $otherLocalityId = new LocalityId(456);
        $otherLocality = new Locality($otherLocalityId, $geographicalNames, $postInfoId);

        $this->assertFalse($locality->sameValueAs($otherLocality));
    }

    /**
     * Not the same value if the post info ids are different.
     *
     * @test
     */
    public function notSameIfPostInfoIdsAreDifferent(): void
    {
        $localityId = new LocalityId(123);
        $geographicalNames = new GeographicalNames(
            new GeographicalName(new LanguageCode('EN'), 'Foo EN')
        );
        $postInfoId = new PostInfoId(9000);

        $locality = new Locality($localityId, $geographicalNames, $postInfoId);

        $otherPostInfoId = new PostInfoId(9123);
        $otherLocality = new Locality($localityId, $geographicalNames, $otherPostInfoId);

        $this->assertFalse($locality->sameValueAs($otherLocality));
    }

    /**
     * Same values if all details are identical.
     *
     * @test
     */
    public function sameIfAllDetailsAreIdentical(): void
    {
        $localityId = new LocalityId(123);
        $geographicalNames = new GeographicalNames(
            new GeographicalName(new LanguageCode('EN'), 'Foo EN')
        );
        $postInfoId = new PostInfoId(9000);

        $locality = new Locality($localityId, $geographicalNames, $postInfoId);
        $sameLocality = new Locality($localityId, $geographicalNames, $postInfoId);

        $this->assertTrue($locality->sameValueAs($sameLocality));
    }

    /**
     * Casting to string returns "[postal code] name".
     *
     * @test
     */
    public function castToStringReturnsPostalCodeAndName(): void
    {
        $localityId = new LocalityId(123);
        $geographicalNames = new GeographicalNames(
            new GeographicalName(new LanguageCode('EN'), 'Foo EN')
        );
        $postInfoId = new PostInfoId(9000);

        $locality = new Locality($localityId, $geographicalNames, $postInfoId);

        $this->assertSame('9000 Foo EN', (string) $locality);
    }
}
