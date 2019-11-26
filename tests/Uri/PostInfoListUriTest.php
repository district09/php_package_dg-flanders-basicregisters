<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Uri;

use DigipolisGent\Flanders\BasicRegisters\Uri\PostInfoListUri;
use PHPStan\Testing\TestCase;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Uri\PostInfoListUri
 */
class PostInfoListUriTest extends TestCase
{
    /**
     * Basic path.
     *
     * @test
     */
    public function uriWithoutFilters(): void
    {
        $uri = new PostInfoListUri();
        $this->assertEquals('postinfo', $uri->getUri());
    }
}
