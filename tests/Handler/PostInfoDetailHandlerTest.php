<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Handler;

use DigipolisGent\Flanders\BasicRegisters\Handler\PostInfoDetailHandler;
use DigipolisGent\Flanders\BasicRegisters\Request\PostInfoDetailRequest;
use DigipolisGent\Flanders\BasicRegisters\Response\PostInfoDetailResponse;
use DigipolisGent\Flanders\BasicRegisters\Value\Geographical\GeographicalName;
use DigipolisGent\Flanders\BasicRegisters\Value\LanguageCode;
use DigipolisGent\Flanders\BasicRegisters\Value\Post\PostInfo;
use DigipolisGent\Flanders\BasicRegisters\Value\Post\PostInfoId;
use DigipolisGent\Flanders\BasicRegisters\Value\Post\PostInfoInterface;
use DigipolisGent\Flanders\BasicRegisters\Value\Post\PostInfoNames;
use GuzzleHttp\Psr7\Stream;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Handler\PostInfoDetailHandler
 */
class PostInfoDetailHandlerTest extends TestCase
{
    /**
     * Json data to test with.
     *
     * @var string
     */
    private $json = <<<EOT
{
    "identificator": {
        "id": "https://data.vlaanderen.be/id/postinfo/9000",
        "naamruimte": "https://data.vlaanderen.be/id/postinfo",
        "objectId": "9000",
        "versieId": 1
    },
    "postnamen": [
        {
            "geografischeNaam": {
                "spelling": "GENT",
                "taal": "NL"
            }
        }
    ],
    "postInfoStatus": "Gerealiseerd"
}
EOT;

    /**
     * Handler handles PostInfoDetailRequest.
     *
     * @test
     */
    public function handlerHandlesPostInfoDetailRequest(): void
    {
        $handler = new PostInfoDetailHandler();

        $this->assertEquals(
            [PostInfoDetailRequest::class],
            $handler->handles()
        );
    }

    /**
     * To response converts the PSR response into an PostInfoDetailResponse.
     *
     * @test
     */
    public function handlerTransformsResponse(): void
    {
        $stream = $this->prophesize(Stream::class);
        $stream->getContents()->willReturn($this->json);
        $response = $this->prophesize(ResponseInterface::class);
        $response->getBody()->willReturn($stream->reveal());

        $expected = new PostInfoDetailResponse($this->createExpectedPostInfoDetail());

        $handler = new PostInfoDetailHandler();
        $this->assertEquals($expected, $handler->toResponse($response->reveal()));
    }

    /**
     * The expected PostInfo detail.
     *
     * @return PostInfoInterface
     */
    private function createExpectedPostInfoDetail(): PostInfoInterface
    {
        return new PostInfo(
            new PostInfoId(9000),
            new PostInfoNames(
                new GeographicalName(
                    new LanguageCode('NL'),
                    'GENT'
                )
            )
        );
    }
}
