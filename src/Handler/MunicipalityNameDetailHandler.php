<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Handler;

use DigipolisGent\API\Client\Handler\HandlerInterface;
use DigipolisGent\API\Client\Response\ResponseInterface;
use DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\Municipality\MunicipalityNameDetailNormalizer;
use DigipolisGent\Flanders\BasicRegisters\Request\MunicipalityNameDetailRequest;
use DigipolisGent\Flanders\BasicRegisters\Response\MunicipalityNameDetailResponse;
use Psr\Http\Message as Psr;

/**
 * Handles the MunicipalityNameDetailRequest request.
 */
final class MunicipalityNameDetailHandler implements HandlerInterface
{
    /**
     * @inheritDoc
     */
    public function handles(): array
    {
        return [MunicipalityNameDetailRequest::class];
    }

    /**
     * @inheritDoc
     */
    public function toResponse(Psr\ResponseInterface $response): ResponseInterface
    {
        $data = json_decode($response->getBody()->getContents());
        $normalizer = new MunicipalityNameDetailNormalizer();

        return new MunicipalityNameDetailResponse(
            $normalizer->normalize($data)
        );
    }
}
