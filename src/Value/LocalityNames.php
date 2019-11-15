<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Value;

use DigipolisGent\Value\CollectionAbstract;

/**
 * Collection of locality names.
 */
final class LocalityNames extends CollectionAbstract
{
    /**
     * Create a new collection.
     *
     * @param \DigipolisGent\Flanders\BasicRegisters\Value\LocalityName ...$localityNames
     *   One or more locality names.
     */
    public function __construct(LocalityName ...$localityNames)
    {
        $this->values = $localityNames;
    }

    /**
     * @inheritDoc
     */
    public function __toString(): string
    {
        $localityNames = [];

        /** @var \DigipolisGent\Flanders\BasicRegisters\Value\LocalityName $localityName */
        foreach ($this->values as $localityName) {
            $localityNames[] = (string) $localityName;
        }

        return implode(', ', $localityNames);
    }
}
