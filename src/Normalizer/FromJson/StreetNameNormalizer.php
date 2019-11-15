<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson;

use DigipolisGent\Flanders\BasicRegisters\Value\GeographicalNames;
use DigipolisGent\Flanders\BasicRegisters\Value\StreetName;
use DigipolisGent\Flanders\BasicRegisters\Value\StreetNameId;

/**
 * Normalizes JSON data into a StreetName object.
 */
class StreetNameNormalizer
{
    /**
     * Normalize the given json object into a StreetName object.
     *
     * @param object $jsonData
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\StreetName
     */
    public function normalize(object $jsonData): StreetName
    {
        $geoGraphicalNameNormalizer = new GeographicalNameNormalizer();

        return new StreetName(
            new StreetNameId((int) $jsonData->identificator->objectId),
            $geoGraphicalNameNormalizer->normalize($jsonData->straatnaam->geografischeNaam)
        );
    }
}
