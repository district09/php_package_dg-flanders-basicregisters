<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Handler;

use DigipolisGent\API\Client\Handler\HandlerInterface;
use DigipolisGent\API\Client\Response\ResponseInterface;
use DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\Post\PostInfoNormalizer;
use DigipolisGent\Flanders\BasicRegisters\Request\PostInfoDetailRequest;
use DigipolisGent\Flanders\BasicRegisters\Response\PostInfoDetailResponse;
use Psr\Http\Message as Psr;

/**
 * Handles the PostInfoDetail request.
 */
final class PostInfoDetailHandler implements HandlerInterface
{
    /**
     * @inheritDoc
     */
    public function handles(): array
    {
        return [PostInfoDetailRequest::class];
    }

    /**
     * @inheritDoc
     */
    public function toResponse(Psr\ResponseInterface $response): ResponseInterface
    {
        $data = json_decode($response->getBody()->getContents());
        $normalizer = new PostInfoNormalizer();

        return new PostInfoDetailResponse(
            $normalizer->normalize($data)
        );
    }
}
