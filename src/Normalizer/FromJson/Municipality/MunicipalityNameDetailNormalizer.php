<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\Municipality;

use DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\Geographical\GeographicalNamesNormalizer;
use DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\IdExtractor;
use DigipolisGent\Flanders\BasicRegisters\Value\Municipality\MunicipalityNameDetail;
use DigipolisGent\Flanders\BasicRegisters\Value\Municipality\MunicipalityNameDetailInterface;
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
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\Municipality\MunicipalityNameDetailInterface
     */
    public function normalize(object $jsonData): MunicipalityNameDetailInterface
    {
        $idExtractor = new IdExtractor();

        return new MunicipalityNameDetail(
            new MunicipalityNameId($idExtractor->extractObjectId($jsonData)),
            (new GeographicalNamesNormalizer())->normalize($jsonData->gemeentenamen)
        );
    }
}
