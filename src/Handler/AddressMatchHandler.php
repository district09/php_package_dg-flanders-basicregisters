<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Handler;

use DigipolisGent\API\Client\Handler\HandlerInterface;
use DigipolisGent\API\Client\Response\ResponseInterface;
use DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\Address\AddressMatchesNormalizer;
use DigipolisGent\Flanders\BasicRegisters\Request\AddressMatchRequest;
use DigipolisGent\Flanders\BasicRegisters\Response\AddressMatchResponse;
use Psr\Http\Message as Psr;

/**
 * Handles the AddressList request.
 */
final class AddressMatchHandler implements HandlerInterface
{
    /**
     * @inheritDoc
     */
    public function handles(): array
    {
        return [AddressMatchRequest::class];
    }

    /**
     * @inheritDoc
     */
    public function toResponse(Psr\ResponseInterface $response): ResponseInterface
    {
        $data = json_decode($response->getBody()->getContents());
        $normalizer = new AddressMatchesNormalizer();

        return new AddressMatchResponse(
            $normalizer->normalize($data)
        );
    }
}
