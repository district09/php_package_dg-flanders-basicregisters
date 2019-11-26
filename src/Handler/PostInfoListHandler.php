<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Handler;

use DigipolisGent\API\Client\Handler\HandlerInterface;
use DigipolisGent\API\Client\Response\ResponseInterface;
use DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\Post\PostInfosNormalizer;
use DigipolisGent\Flanders\BasicRegisters\Request\PostInfoListRequest;
use DigipolisGent\Flanders\BasicRegisters\Response\PostInfoListResponse;
use Psr\Http\Message as Psr;

/**
 * Handles the PostInfoList request.
 */
final class PostInfoListHandler implements HandlerInterface
{
    /**
     * @inheritDoc
     */
    public function handles(): array
    {
        return [PostInfoListRequest::class];
    }

    /**
     * @inheritDoc
     */
    public function toResponse(Psr\ResponseInterface $response): ResponseInterface
    {
        $data = json_decode($response->getBody()->getContents());
        $normalizer = new PostInfosNormalizer();

        return new PostInfoListResponse(
            $normalizer->normalize($data)
        );
    }
}
