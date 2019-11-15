<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Value;

use DigipolisGent\Value\CollectionAbstract;

/**
 * Collection of addresses
 */
final class Addresses extends CollectionAbstract
{
    /**
     * Create a new collection.
     *
     * @param \DigipolisGent\Flanders\BasicRegisters\Value\Address ...$addresses
     *   One or more addresses.
     */
    public function __construct(Address ...$addresses)
    {
        $this->values = $addresses;
    }

    /**
     * @inheritDoc
     */
    public function __toString(): string
    {
        $addresses = [];

        /** @var \DigipolisGent\Flanders\BasicRegisters\Value\Address $address */
        foreach ($this->values as $address) {
            $addresses[] = (string) $address;
        }

        return implode('; ', $addresses);
    }
}
