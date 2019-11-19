<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Handler;

use DigipolisGent\API\Client\Handler\HandlerInterface;
use DigipolisGent\API\Client\Response\ResponseInterface;
use DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\Address\AddressesNormalizer;
use DigipolisGent\Flanders\BasicRegisters\Request\AddressListRequest;
use DigipolisGent\Flanders\BasicRegisters\Response\AddressListResponse;
use Psr\Http\Message as Psr;

/**
 * Handles the list request.
 */
final class AddressListHandler implements HandlerInterface
{
    /**
     * @inheritDoc
     */
    public function handles(): array
    {
        return [AddressListRequest::class];
    }

    /**
     * @inheritDoc
     */
    public function toResponse(Psr\ResponseInterface $response): ResponseInterface
    {
        $data = json_decode($response->getBody()->getContents());
        $normalizer = new AddressesNormalizer();

        return new AddressListResponse(
            $normalizer->normalize($data)
        );
    }
}
