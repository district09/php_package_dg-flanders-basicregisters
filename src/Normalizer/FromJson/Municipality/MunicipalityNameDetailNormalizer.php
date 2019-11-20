<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\Municipality;

use DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\Geographical\GeographicalNamesNormalizer;
use DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\IdExtractor;
use DigipolisGent\Flanders\BasicRegisters\Value\Municipality\MunicipalityNameDetail;
use DigipolisGent\Flanders\BasicRegisters\Value\Municipality\MunicipalityNameId;

/**
 * Normalizes JSON data into a MunicipalityNameDetail value.
 */
final class MunicipalityNameDetailNormalizer
{
    /**
     * Normalize the given json data.
     *
     * @param object $jsonData
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\Municipality\MunicipalityNameDetail
     */
    public function normalize(object $jsonData): MunicipalityNameDetail
    {
        $idExtractor = new IdExtractor();
        $geoGraphicalNamesNormalizer = new GeographicalNamesNormalizer();

        return new MunicipalityNameDetail(
            new MunicipalityNameId($idExtractor->extractObjectId($jsonData)),
            $geoGraphicalNamesNormalizer->normalize($jsonData->gemeentenamen)
        );
    }
}
