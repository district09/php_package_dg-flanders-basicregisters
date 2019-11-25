<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Handler;

use DigipolisGent\API\Client\Handler\HandlerInterface;
use DigipolisGent\API\Client\Response\ResponseInterface;
use DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\Street\StreetNameDetailNormalizer;
use DigipolisGent\Flanders\BasicRegisters\Request\StreetNameDetailRequest;
use DigipolisGent\Flanders\BasicRegisters\Response\StreetNameDetailResponse;
use Psr\Http\Message as Psr;

/**
 * Handles the StreetNameDetail request.
 */
final class StreetNameDetailHandler implements HandlerInterface
{
    /**
     * @inheritDoc
     */
    public function handles(): array
    {
        return [StreetNameDetailRequest::class];
    }

    /**
     * @inheritDoc
     */
    public function toResponse(Psr\ResponseInterface $response): ResponseInterface
    {
        $data = json_decode($response->getBody()->getContents());
        $normalizer = new StreetNameDetailNormalizer();

        return new StreetNameDetailResponse(
            $normalizer->normalize($data)
        );
    }
}
