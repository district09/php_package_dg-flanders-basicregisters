<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Value\Post;

use DigipolisGent\Flanders\BasicRegisters\Value\Geographical\GeographicalName;
use DigipolisGent\Flanders\BasicRegisters\Value\LanguageCode;
use DigipolisGent\Flanders\BasicRegisters\Value\Post\PostInfo;
use DigipolisGent\Flanders\BasicRegisters\Value\Post\PostInfoId;
use DigipolisGent\Flanders\BasicRegisters\Value\Post\PostInfoNames;
use DigipolisGent\Tests\Flanders\BasicRegisters\TestCase;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Value\Post\PostInfo
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
        $postInfoNames = new PostInfoNames(
            new GeographicalName(new LanguageCode('NL'), 'Foo name')
        );

        $postInfo = new PostInfo($postInfoId, $postInfoNames);

        $this->assertSame($postInfoId, $postInfo->postInfoId());
        $this->assertSame($postInfoNames, $postInfo->postInfoNames());
    }

    /**
     * Postal code is extracted from the post info id.
     *
     * @test
     */
    public function postalCodeIsExtractedFromPostInfoId(): void
    {
        $postInfoId = new PostInfoId(9010);
        $postInfoNames = new PostInfoNames(
            new GeographicalName(new LanguageCode('NL'), 'Foo name')
        );

        $postInfo = new PostInfo($postInfoId, $postInfoNames);

        $this->assertSame(9010, $postInfo->postalCode());
    }

    /**
     * Name is extracted from the postInfoNames.
     *
     * @test
     */
    public function nameIsExtractedFromPostInfoNames(): void
    {
        $postInfoId = new PostInfoId(9010);
        $postInfoNames = new PostInfoNames(
            new GeographicalName(new LanguageCode('NL'), 'Foo name')
        );

        $postInfo = new PostInfo($postInfoId, $postInfoNames);

        $this->assertSame($postInfoNames->name(), $postInfo->name());
    }

    /**
     * Not the same value if the postInfoId is different.
     *
     * @test
     */
    public function notSameValueIfPostInfoIdIsDifferent(): void
    {
        $postInfoId = new PostInfoId(9010);
        $postInfoNames = new PostInfoNames(
            new GeographicalName(new LanguageCode('NL'), 'Foo name')
        );

        $postInfo = new PostInfo($postInfoId, $postInfoNames);
        $otherPostInfo = new PostInfo(new PostInfoId(9020), $postInfoNames);

        $this->assertFalse($postInfo->sameValueAs($otherPostInfo));
    }

    /**
     * Not the same value if the postInfoNames are different.
     *
     * @test
     */
    public function notSameValueIfPostInfoNamesAreDifferent(): void
    {
        $postInfoId = new PostInfoId(9010);
        $postInfoNames = new PostInfoNames(
            new GeographicalName(new LanguageCode('NL'), 'Foo name')
        );

        $otherPostInfoNames = new PostInfoNames(
            new GeographicalName(new LanguageCode('NL'), 'Biz name')
        );

        $postInfo = new PostInfo($postInfoId, $postInfoNames);
        $otherPostInfo = new PostInfo($postInfoId, $otherPostInfoNames);

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
        $postInfoNames = new PostInfoNames(
            new GeographicalName(new LanguageCode('NL'), 'Foo name')
        );

        $postInfo = new PostInfo($postInfoId, $postInfoNames);
        $samePostInfo = new PostInfo($postInfoId, $postInfoNames);

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
        $postInfoNames = new PostInfoNames(
            new GeographicalName(new LanguageCode('NL'), 'Foo name')
        );

        $postInfo = new PostInfo($postInfoId, $postInfoNames);

        $this->assertSame('9010 Foo name', (string) $postInfo);
    }
}
