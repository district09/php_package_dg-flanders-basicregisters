<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Response;

use DigipolisGent\API\Client\Response\ResponseInterface;
use DigipolisGent\Flanders\BasicRegisters\Value\Street\StreetNames;

/**
 * Response containing the street names collection.
 */
final class StreetNameListResponse implements ResponseInterface
{
    /**
     * Street names collection.
     *
     * @var \DigipolisGent\Flanders\BasicRegisters\Value\Street\StreetNames
     */
    private $streetNames;

    /**
     * Constructor.
     *
     * @param \DigipolisGent\Flanders\BasicRegisters\Value\Street\StreetNames $streetNames
     */
    public function __construct(StreetNames $streetNames)
    {
        $this->streetNames = $streetNames;
    }

    /**
     * Get the street names collection.
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\Street\StreetNames
     */
    public function streetNames(): StreetNames
    {
        return $this->streetNames;
    }
}
