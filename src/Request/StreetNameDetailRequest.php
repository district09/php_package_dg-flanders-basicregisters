<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Request;

use DigipolisGent\API\Client\Request\AbstractRequest;
use DigipolisGent\Flanders\BasicRegisters\Uri\StreetNameDetailUri;
use DigipolisGent\Flanders\BasicRegisters\Value\Street\StreetNameId;

/**
 * Request to get the details of a single street name.
 */
final class StreetNameDetailRequest extends AbstractRequest
{
    /**
     * Create a new street name detail request.
     *
     * @param \DigipolisGent\Flanders\BasicRegisters\Value\Street\StreetNameId $streetNameId
     */
    public function __construct(StreetNameId $streetNameId)
    {
        parent::__construct(
            new StreetNameDetailUri($streetNameId)
        );
    }
}
