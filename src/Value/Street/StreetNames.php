<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Value\Street;

use DigipolisGent\Value\CollectionAbstract;

/**
 * Collection of street names.
 */
final class StreetNames extends CollectionAbstract
{
    /**
     * Create a new collection.
     *
     * @param \DigipolisGent\Flanders\BasicRegisters\Value\Street\StreetName ...$streetNames
     *   One or more street names.
     */
    public function __construct(StreetName ...$streetNames)
    {
        $this->values = $streetNames;
    }

    /**
     * @inheritDoc
     */
    public function __toString(): string
    {
        $streetNames = [];

        /** @var \DigipolisGent\Flanders\BasicRegisters\Value\Street\StreetName $streetName */
        foreach ($this->values as $streetName) {
            $streetNames[] = (string) $streetName;
        }

        return implode(', ', $streetNames);
    }
}
