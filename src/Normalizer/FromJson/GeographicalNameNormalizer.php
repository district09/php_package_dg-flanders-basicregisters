<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson;

use DigipolisGent\Flanders\BasicRegisters\Value\GeographicalName;
use DigipolisGent\Flanders\BasicRegisters\Value\LanguageCode;

/**
 * Normalizes json data into a GeoGraphicalName value.
 */
final class GeographicalNameNormalizer
{
    /**
     * Normalize the json data.
     *
     * @param object $jsonData
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\GeographicalName
     */
    public function normalize(object $jsonData): GeographicalName
    {
        return new GeographicalName(
            new LanguageCode($jsonData->taal),
            $jsonData->spelling
        );
    }
}
