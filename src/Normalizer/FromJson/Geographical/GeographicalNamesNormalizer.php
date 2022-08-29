<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\Geographical;

use DigipolisGent\Flanders\BasicRegisters\Value\Geographical\GeographicalNames;

/**
 * Normalizes json data into a GeoGraphicalNames collection.
 */
final class GeographicalNamesNormalizer
{
    /**
     * Normalize the json data.
     *
     * @param array $jsonData
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\Geographical\GeographicalNames
     */
    public function normalize(array $jsonData): GeographicalNames
    {
        $nameNormalizer = new GeographicalNameNormalizer();

        $geographicalNames = [];
        foreach ($jsonData as $geographicalNameData) {
            $geographicalNames[] = $nameNormalizer
                ->normalize($geographicalNameData);
        }

        return new GeographicalNames(...$geographicalNames);
    }
}
