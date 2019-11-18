<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson;

use DigipolisGent\Flanders\BasicRegisters\Value\StreetNames;

/**
 * Normalizes JSON data into a StreetNames collection object.
 */
final class StreetNamesNormalizer
{
    /**
     * Normalize the given json object into a StreetNames collection.
     *
     * @param object $jsonData
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\StreetNames
     */
    public function normalize(object $jsonData): StreetNames
    {
        $streetNameNormalizer = new StreetNameNormalizer();

        $streetNames = [];
        foreach ($jsonData->straatnamen as $jsonStreetData) {
            $streetNames[] = $streetNameNormalizer->normalize($jsonStreetData);
        }

        return new StreetNames(...$streetNames);
    }
}
