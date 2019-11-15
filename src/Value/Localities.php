<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Value;

use DigipolisGent\Value\CollectionAbstract;

/**
 * Collection of localities.
 */
final class Localities extends CollectionAbstract
{
    /**
     * Create a new collection.
     *
     * @param \DigipolisGent\Flanders\BasicRegisters\Value\Locality ...$localities
     *   One or more localities.
     */
    public function __construct(Locality ...$localities)
    {
        $this->values = $localities;
    }

    /**
     * @inheritDoc
     */
    public function __toString(): string
    {
        $localities = [];

        /** @var \DigipolisGent\Flanders\BasicRegisters\Value\Locality $locality */
        foreach ($this->values as $locality) {
            $localities[] = (string) $locality;
        }

        return implode(', ', $localities);
    }
}
