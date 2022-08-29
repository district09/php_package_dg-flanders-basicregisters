<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Uri;

use DigipolisGent\Flanders\BasicRegisters\Uri\PostInfoDetailUri;
use DigipolisGent\Flanders\BasicRegisters\Value\Post\PostInfoId;
use DigipolisGent\Tests\Flanders\BasicRegisters\TestCase;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Uri\PostInfoDetailUri
 */
class PostInfoDetailUriTest extends TestCase
{
    /**
     * URI contains the ID of the post info.
     *
     * @test
     */
    public function uriContainsPostInfoId(): void
    {
        $postInfoId = new PostInfoId(9000);
        $uri = new PostInfoDetailUri($postInfoId);

        $this->assertSame('postinfo/9000', $uri->getUri());
    }
}
