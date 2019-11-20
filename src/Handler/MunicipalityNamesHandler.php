<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Handler;

use DigipolisGent\API\Client\Handler\HandlerInterface;
use DigipolisGent\API\Client\Response\ResponseInterface;
use DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\Municipality\MunicipalityNamesNormalizer;
use DigipolisGent\Flanders\BasicRegisters\Request\MunicipalityNamesRequest;
use DigipolisGent\Flanders\BasicRegisters\Response\MunicipalityNamesResponse;
use Psr\Http\Message as Psr;

/**
 * Handles the MunicipalityNames request.
 */
final class MunicipalityNamesHandler implements HandlerInterface
{
    /**
     * @inheritDoc
     */
    public function handles(): array
    {
        return [MunicipalityNamesRequest::class];
    }

    /**
     * @inheritDoc
     */
    public function toResponse(Psr\ResponseInterface $response): ResponseInterface
    {
        $data = json_decode($response->getBody()->getContents());
        $normalizer = new MunicipalityNamesNormalizer();

        return new MunicipalityNamesResponse(
            $normalizer->normalize($data)
        );
    }
}
