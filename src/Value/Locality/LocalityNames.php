<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Value\Locality;

use DigipolisGent\Value\CollectionAbstract;

/**
 * Collection of locality names.
 */
final class LocalityNames extends CollectionAbstract
{
    /**
     * Create a new collection.
     *
     * @param \DigipolisGent\Flanders\BasicRegisters\Value\Locality\LocalityName ...$localityNames
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

        /** @var \DigipolisGent\Flanders\BasicRegisters\Value\Locality\LocalityName $localityName */
        foreach ($this->values as $localityName) {
            $localityNames[] = (string) $localityName;
        }

        return implode(', ', $localityNames);
    }
}
