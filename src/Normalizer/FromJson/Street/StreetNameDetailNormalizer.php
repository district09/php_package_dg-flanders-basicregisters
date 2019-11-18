<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\Street;

use DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\Geographical\GeographicalNamesNormalizer;
use DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\IdExtractor;
use DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\Locality\LocalityNameNormalizer;
use DigipolisGent\Flanders\BasicRegisters\Value\Street\StreetNameDetail;
use DigipolisGent\Flanders\BasicRegisters\Value\Street\StreetNameId;

/**
 * Normalizes JSON data into a StreetNameDetail value.
 */
final class StreetNameDetailNormalizer
{
    /**
     * Normalize the json data
     *
     * @param object $jsonData
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\Street\StreetNameDetail
     */
    public function normalize(object $jsonData): StreetNameDetail
    {
        $idExtractor = new IdExtractor();
        $geoGraphicalNamesNormalizer = new GeographicalNamesNormalizer();
        $localityNameNormalizer = new LocalityNameNormalizer();

        return new StreetNameDetail(
            new StreetNameId($idExtractor->extractObjectId($jsonData)),
            $geoGraphicalNamesNormalizer->normalize($jsonData->straatnamen),
            $localityNameNormalizer->normalize($jsonData->gemeente)
        );
    }
}
