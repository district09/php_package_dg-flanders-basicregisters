<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Response;

use DigipolisGent\Flanders\BasicRegisters\Response\PostInfoListResponse;
use DigipolisGent\Flanders\BasicRegisters\Value\Post\PostInfos;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Response\PostInfoListResponse
 */
class PostInfoListResponseTest extends TestCase
{
    /**
     * Response is created with PostInfos collection.
     *
     * @test
     */
    public function responseHasPostInfosCollection(): void
    {
        $postInfos = new PostInfos();
        $response = new PostInfoListResponse($postInfos);

        $this->assertSame($postInfos, $response->postInfos());
    }
}
