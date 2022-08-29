<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\Municipality;

use DigipolisGent\Flanders\BasicRegisters\Value\Municipality\MunicipalityNames;

/**
 * Normalizes JSON data into a MunicipalityNames collection.
 */
final class MunicipalityNamesNormalizer
{
    /**
     * Normalize the json data.
     *
     * @param object $jsonData
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\Municipality\MunicipalityNames
     */
    public function normalize(object $jsonData): MunicipalityNames
    {
        $nameNormalizer = new MunicipalityNameNormalizer();
        $municipalityNames = [];
        foreach ($jsonData->gemeenten as $municipalityData) {
            $municipalityNames[] = $nameNormalizer->normalize($municipalityData);
        }

        return new MunicipalityNames(...$municipalityNames);
    }
}
