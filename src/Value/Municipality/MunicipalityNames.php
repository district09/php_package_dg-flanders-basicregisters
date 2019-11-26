<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Value\Municipality;

use DigipolisGent\Value\CollectionAbstract;

/**
 * Collection of municipality names.
 */
final class MunicipalityNames extends CollectionAbstract
{
    /**
     * Create a new collection.
     *
     * @param \DigipolisGent\Flanders\BasicRegisters\Value\Municipality\MunicipalityName ...$municipalityNames
     *   One or more municipality names.
     */
    public function __construct(MunicipalityName ...$municipalityNames)
    {
        $this->values = $municipalityNames;
    }

    /**
     * @inheritDoc
     */
    public function __toString(): string
    {
        $municipalityNames = [];

        /** @var \DigipolisGent\Flanders\BasicRegisters\Value\Municipality\MunicipalityName $municipalityName */
        foreach ($this->values as $municipalityName) {
            $municipalityNames[] = (string) $municipalityName;
        }

        return implode(', ', $municipalityNames);
    }
}
