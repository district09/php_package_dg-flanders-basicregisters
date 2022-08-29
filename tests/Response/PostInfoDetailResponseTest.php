<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Response;

use DigipolisGent\Flanders\BasicRegisters\Response\PostInfoDetailResponse;
use DigipolisGent\Flanders\BasicRegisters\Value\Post\PostInfoInterface;
use DigipolisGent\Tests\Flanders\BasicRegisters\TestCase;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Response\PostInfoDetailResponse
 */
class PostInfoDetailResponseTest extends TestCase
{
    /**
     * Response is created with PostInfo detail value.
     *
     * @test
     */
    public function responseHasPostInfoDetailValue(): void
    {
        $postInfo = $this
            ->prophesize(PostInfoInterface::class)
            ->reveal();
        $response = new PostInfoDetailResponse($postInfo);

        $this->assertSame($postInfo, $response->postInfo());
    }
}
