<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Value\Post;

use DigipolisGent\Flanders\BasicRegisters\Value\Geographical\GeographicalName;
use DigipolisGent\Flanders\BasicRegisters\Value\LanguageCode;
use DigipolisGent\Flanders\BasicRegisters\Value\Post\PostInfo;
use DigipolisGent\Flanders\BasicRegisters\Value\Post\PostInfoId;
use DigipolisGent\Flanders\BasicRegisters\Value\Post\PostInfoInterface;
use DigipolisGent\Flanders\BasicRegisters\Value\Post\PostInfoNames;
use DigipolisGent\Flanders\BasicRegisters\Value\Post\PostInfos;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Value\Post\PostInfos
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
     * Create a PostInfo object.
     *
     * @param int $identifier
     * @param string $name
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\Post\PostInfoInterface
     */
    public function createPostInfo(int $identifier, string $name): PostInfoInterface
    {
        return new PostInfo(
            new PostInfoId($identifier),
            new PostInfoNames(
                new GeographicalName(
                    new LanguageCode('NL'),
                    $name
                )
            )
        );
    }
}
