<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\Municipality;

use DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\Geographical\GeographicalNameNormalizer;
use DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\IdExtractor;
use DigipolisGent\Flanders\BasicRegisters\Value\Municipality\MunicipalityNameId;
use DigipolisGent\Flanders\BasicRegisters\Value\Municipality\MunicipalityName;

/**
 * Normalizes JSON data into a MunicipalityName value.
 */
final class MunicipalityNameNormalizer
{
    /**
     * Normalize the json data.
     *
     * @param object $jsonData
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\Municipality\MunicipalityName
     */
    public function normalize(object $jsonData): MunicipalityName
    {
        $idExtractor = new IdExtractor();
        $geoGraphicalNameNormalizer = new GeographicalNameNormalizer();

        return new MunicipalityName(
            new MunicipalityNameId($idExtractor->extractObjectId($jsonData)),
            $geoGraphicalNameNormalizer->normalize($jsonData->gemeentenaam->geografischeNaam)
        );
    }
}
