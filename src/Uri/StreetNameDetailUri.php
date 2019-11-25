<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Uri;

use DigipolisGent\API\Client\Uri\UriInterface;
use DigipolisGent\Flanders\BasicRegisters\Value\Street\StreetNameId;

/**
 * URI to get the details of a street name.
 */
class StreetNameDetailUri implements UriInterface
{
    /**
     * The street name ID.
     *
     * @var \DigipolisGent\Flanders\BasicRegisters\Value\Street\StreetNameId
     */
    private $streetNameId;

    /**
     * Create a new URI by passing the StreetNameId value.
     *
     * @param \DigipolisGent\Flanders\BasicRegisters\Value\Street\StreetNameId $streetNameId
     */
    public function __construct(StreetNameId $streetNameId)
    {
        $this->streetNameId = $streetNameId;
    }

    /**
     * @inheritDoc
     */
    public function getUri()
    {
        return sprintf('straatnamen/%d', $this->streetNameId->value());
    }
}
