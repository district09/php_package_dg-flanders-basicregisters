<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Value;

use DigipolisGent\Flanders\BasicRegisters\Value\GeographicalName;
use DigipolisGent\Flanders\BasicRegisters\Value\GeographicalNames;
use DigipolisGent\Flanders\BasicRegisters\Value\LanguageCode;
use DigipolisGent\Flanders\BasicRegisters\Value\PostInfo;
use DigipolisGent\Flanders\BasicRegisters\Value\PostInfoId;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Value\PostInfo
 */
class PostInfoTest extends TestCase
{
    /**
     * Value is created from its details.
     *
     * @test
     */
    public function valueIsCreatedFromItsDetails(): void
    {
        $postInfoId = new PostInfoId(9010);
        $geoGraphicalNames = new GeographicalNames(
            new GeographicalName(new LanguageCode('NL'), 'Foo name')
        );

        $postInfo = new PostInfo($postInfoId, $geoGraphicalNames);

        $this->assertSame($postInfoId, $postInfo->postInfoId());
        $this->assertSame($geoGraphicalNames, $postInfo->geographicalNames());
    }

    /**
     * Postal code is extracted from the post info id.
     *
     * @test
     */
    public function postalCodeIsExtractedFromPostInfoId(): void
    {
        $postInfoId = new PostInfoId(9010);
        $geoGraphicalNames = new GeographicalNames(
            new GeographicalName(new LanguageCode('NL'), 'Foo name')
        );

        $postInfo = new PostInfo($postInfoId, $geoGraphicalNames);

        $this->assertSame(9010, $postInfo->postalCode());
    }

    /**
     * Not the same value if the postInfoId is different.
     *
     * @test
     */
    public function notSameValueIfPostInfoIdIsDifferent(): void
    {
        $postInfoId = new PostInfoId(9010);
        $geoGraphicalNames = new GeographicalNames(
            new GeographicalName(new LanguageCode('NL'), 'Foo name')
        );

        $postInfo = new PostInfo($postInfoId, $geoGraphicalNames);
        $otherPostInfo = new PostInfo(new PostInfoId(9020), $geoGraphicalNames);

        $this->assertFalse($postInfo->sameValueAs($otherPostInfo));
    }

    /**
     * Same value if all details are identical.
     *
     * @test
     */
    public function sameIfAllDetailsAreIdentical(): void
    {
        $postInfoId = new PostInfoId(9010);
        $geoGraphicalNames = new GeographicalNames(
            new GeographicalName(new LanguageCode('NL'), 'Foo name')
        );

        $postInfo = new PostInfo($postInfoId, $geoGraphicalNames);
        $samePostInfo = new PostInfo($postInfoId, $geoGraphicalNames);

        $this->assertTrue($postInfo->sameValueAs($samePostInfo));
    }

    /**
     * Cast to string returns "[postal code] [name]".
     *
     * @test
     */
    public function castToStringCombinesPostalCodeAndName(): void
    {
        $postInfoId = new PostInfoId(9010);
        $geoGraphicalNames = new GeographicalNames(
            new GeographicalName(new LanguageCode('NL'), 'Foo name')
        );

        $postInfo = new PostInfo($postInfoId, $geoGraphicalNames);

        $this->assertSame('9010 Foo name', (string) $postInfo);
    }
}
