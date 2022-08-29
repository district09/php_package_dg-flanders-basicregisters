<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Request;

use DigipolisGent\Flanders\BasicRegisters\Request\PostInfoListRequest;
use DigipolisGent\Tests\Flanders\BasicRegisters\TestCase;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Request\PostInfoListRequest
 */
class PostInfoListRequestTest extends TestCase
{
    /**
     * The URI is set.
     *
     * @test
     */
    public function defaultUriWithoutFilters(): void
    {
        $request = new PostInfoListRequest();
        $this->assertEquals('postinfo', $request->getRequestTarget());
    }
}
