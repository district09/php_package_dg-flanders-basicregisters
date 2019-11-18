<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson;

use DigipolisGent\Flanders\BasicRegisters\Value\LocalityNameId;
use DigipolisGent\Flanders\BasicRegisters\Value\LocalityName;

/**
 * Normalizes JSON data into a LocalityName value.
 */
final class LocalityNameNormalizer
{
    /**
     * Normalize the given json object into a LocalityName value.
     *
     * @param object $jsonData
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\LocalityName
     */
    public function normalize(object $jsonData): LocalityName
    {
        $geoGraphicalNameNormalizer = new GeographicalNameNormalizer();

        return new LocalityName(
            new LocalityNameId((int) $jsonData->objectId),
            $geoGraphicalNameNormalizer->normalize($jsonData->gemeentenaam->geografischeNaam)
        );
    }
}
