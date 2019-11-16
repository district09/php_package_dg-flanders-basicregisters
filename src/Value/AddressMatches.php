<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Value;

use DigipolisGent\Value\CollectionAbstract;

/**
 * Collection of address matches.
 */
final class AddressMatches extends CollectionAbstract
{
    /**
     * Create a new collection.
     *
     * @param \DigipolisGent\Flanders\BasicRegisters\Value\AddressMatchInterface ...$addressMatches
     *   One or more addresses.
     */
    public function __construct(AddressMatchInterface ...$addressMatches)
    {
        $this->values = $addressMatches;
    }

    /**
     * @inheritDoc
     */
    public function __toString(): string
    {
        $addressMatches = [];

        /** @var \DigipolisGent\Flanders\BasicRegisters\Value\AddressMatchInterface $addressMatch */
        foreach ($this->values as $addressMatch) {
            $addressMatches[] = (string) $addressMatch;
        }

        return implode('; ', $addressMatches);
    }
}
