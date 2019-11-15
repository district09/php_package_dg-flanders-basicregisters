<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Value;

use DigipolisGent\Flanders\BasicRegisters\Value\GeographicalName;
use DigipolisGent\Flanders\BasicRegisters\Value\GeographicalNames;
use DigipolisGent\Flanders\BasicRegisters\Value\LanguageCode;
use DigipolisGent\Flanders\BasicRegisters\Value\PostInfo;
use DigipolisGent\Flanders\BasicRegisters\Value\PostInfoId;
use DigipolisGent\Flanders\BasicRegisters\Value\PostInfos;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Value\PostInfos
 */
class PostInfosTest extends TestCase
{
    /**
     * Casting to string returns all address as string.
     *
     * @test
     */
    public function castToStringReturnsAllPostInfosAsString(): void
    {
        $postInfo1 = $this->createPostInfo(9010, 'Name 1');
        $postInfo2 = $this->createPostInfo(9020, 'Name 2');

        $postInfos = new PostInfos($postInfo1, $postInfo2);

        $this->assertEquals(
            '9010 Name 1, 9020 Name 2',
            (string) $postInfos
        );
    }

    /**
     * Create an PostInfo object.
     *
     * @param int $identifier
     * @param string $name
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\PostInfo
     */
    public function createPostInfo(int $identifier, string $name): PostInfo
    {
        return new PostInfo(
            new PostInfoId($identifier),
            new GeographicalNames(
                new GeographicalName(
                    new LanguageCode('NL'),
                    $name
                )
            )
        );
    }
}
