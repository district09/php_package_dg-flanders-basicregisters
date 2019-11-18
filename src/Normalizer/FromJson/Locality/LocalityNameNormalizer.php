<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\Locality;

use DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\Geographical\GeographicalNameNormalizer;
use DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\IdExtractor;
use DigipolisGent\Flanders\BasicRegisters\Value\Locality\LocalityNameId;
use DigipolisGent\Flanders\BasicRegisters\Value\Locality\LocalityName;

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
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\Locality\LocalityName
     */
    public function normalize(object $jsonData): LocalityName
    {
        $idExtractor = new IdExtractor();
        $geoGraphicalNameNormalizer = new GeographicalNameNormalizer();

        return new LocalityName(
            new LocalityNameId($idExtractor->extractObjectId($jsonData)),
            $geoGraphicalNameNormalizer->normalize($jsonData->gemeentenaam->geografischeNaam)
        );
    }
}
