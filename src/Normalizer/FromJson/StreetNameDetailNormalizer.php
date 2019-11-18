<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson;

use DigipolisGent\Flanders\BasicRegisters\Value\Street\StreetNameDetail;
use DigipolisGent\Flanders\BasicRegisters\Value\Street\StreetNameId;

/**
 * Normalizes JSON data into a StreetNameDetail value.
 */
final class StreetNameDetailNormalizer
{
    /**
     * Normalize the given json object into a StreetNameDetail object.
     *
     * @param object $jsonData
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\Street\StreetNameDetail
     */
    public function normalize(object $jsonData): StreetNameDetail
    {
        $geoGraphicalNamesNormalizer = new GeographicalNamesNormalizer();
        $localityNameNormalizer = new LocalityNameNormalizer();

        return new StreetNameDetail(
            new StreetNameId((int) $jsonData->identificator->objectId),
            $geoGraphicalNamesNormalizer->normalize($jsonData->straatnamen),
            $localityNameNormalizer->normalize($jsonData->gemeente)
        );
    }
}
