<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\Locality;

use DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\GeographicalNamesNormalizer;
use DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\IdExtractor;
use DigipolisGent\Flanders\BasicRegisters\Value\Locality\LocalityNameDetail;
use DigipolisGent\Flanders\BasicRegisters\Value\Locality\LocalityNameId;

/**
 * Normalizes JSON data into a LocalityNameDetail value.
 */
final class LocalityNameDetailNormalizer
{
    /**
     * Normalize the given json object into a LocalityName value.
     *
     * @param object $jsonData
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\Locality\LocalityNameDetail
     */
    public function normalize(object $jsonData): LocalityNameDetail
    {
        $idExtractor = new IdExtractor();
        $geoGraphicalNamesNormalizer = new GeographicalNamesNormalizer();

        return new LocalityNameDetail(
            new LocalityNameId($idExtractor->extractObjectId($jsonData)),
            $geoGraphicalNamesNormalizer->normalize($jsonData->gemeentenamen)
        );
    }
}
