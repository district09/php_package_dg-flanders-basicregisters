<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Request;

use DigipolisGent\Flanders\BasicRegisters\Request\PostInfoDetailRequest;
use DigipolisGent\Flanders\BasicRegisters\Value\Post\PostInfoId;
use DigipolisGent\Tests\Flanders\BasicRegisters\TestCase;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Request\PostInfoDetailRequest
 */
class PostInfoDetailRequestTest extends TestCase
{
    /**
     * The URI is set.
     *
     * @test
     */
    public function requestUriIsSet(): void
    {
        $postInfoId = new PostInfoId(9000);
        $request = new PostInfoDetailRequest($postInfoId);

        $this->assertEquals('postinfo/9000', $request->getRequestTarget());
    }
}
