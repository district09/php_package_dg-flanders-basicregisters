<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson;

use DigipolisGent\Flanders\BasicRegisters\Value\Street\StreetName;
use DigipolisGent\Flanders\BasicRegisters\Value\Street\StreetNameId;

/**
 * Normalizes JSON data into a StreetName object.
 */
final class StreetNameNormalizer
{
    /**
     * Normalize the given json object into a StreetName object.
     *
     * @param object $jsonData
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\Street\StreetName
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
