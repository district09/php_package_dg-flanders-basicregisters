<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Handler;

use DigipolisGent\Flanders\BasicRegisters\Handler\PostInfoListHandler;
use DigipolisGent\Flanders\BasicRegisters\Request\PostInfoListRequest;
use DigipolisGent\Flanders\BasicRegisters\Response\PostInfoListResponse;
use DigipolisGent\Flanders\BasicRegisters\Value\Post\PostInfos;
use GuzzleHttp\Psr7\Stream;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Handler\PostInfoListHandler
 */
class PostInfoListHandlerTest extends TestCase
{
    /**
     * Handler handles PostInfoList request.
     *
     * @test
     */
    public function handlerHandlesPostInfoListRequest(): void
    {
        $handler = new PostInfoListHandler();

        $this->assertEquals(
            [PostInfoListRequest::class],
            $handler->handles()
        );
    }

    /**
     * To response converts the PSR response into a PostInfoListResponse.
     *
     * @test
     */
    public function handlerTransformsResponse(): void
    {
        $stream = $this->prophesize(Stream::class);
        $stream->getContents()->willReturn('{"postInfoObjecten":[], "totaalAantal":0}');
        $response = $this->prophesize(ResponseInterface::class);
        $response->getBody()->willReturn($stream->reveal());

        $expected = new PostInfoListResponse(new PostInfos());

        $handler = new PostInfoListHandler();
        $this->assertEquals($expected, $handler->toResponse($response->reveal()));
    }
}
