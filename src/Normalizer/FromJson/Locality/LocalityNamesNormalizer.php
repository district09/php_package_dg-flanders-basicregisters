<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\Locality;

use DigipolisGent\Flanders\BasicRegisters\Value\Locality\LocalityNames;

/**
 * Normalizes JSON data into a LocalityNames collection.
 */
final class LocalityNamesNormalizer
{
    /**
     * Normalize the given json object into a LocalityNames collection.
     *
     * @param object $jsonData
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\Locality\LocalityNames
     */
    public function normalize(object $jsonData): LocalityNames
    {
        $localityNameNormalizer = new LocalityNameNormalizer();
        $localityNames = [];
        foreach ($jsonData->gemeenten as $localityData) {
            $localityNames[] = $localityNameNormalizer->normalize($localityData);
        }

        return new LocalityNames(...$localityNames);
    }
}
