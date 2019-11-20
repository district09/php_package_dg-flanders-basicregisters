<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\Address;

use DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\Locality\LocalityNameNormalizer;
use DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\Street\StreetNameNormalizer;
use DigipolisGent\Flanders\BasicRegisters\Value\Address\AddressMatch;

/**
 * Normalizes json data into an AddressMatch value.
 */
class AddressMatchNormalizer
{
    /**
     * Normalize the json data.
     *
     * @param object $jsonData
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\Address\AddressMatch
     */
    public function normalize(object $jsonData): AddressMatch
    {
        $localityNameNormalizer = new LocalityNameNormalizer();
        $streetNameNormalizer = new StreetNameNormalizer();

        $addressDetail = null;
        if (!empty($jsonData->identificator)) {
            $addressDetailNormalizer = new AddressDetailNormalizer();
            $addressDetail = $addressDetailNormalizer->normalize($jsonData);
        }

        return new AddressMatch(
            $localityNameNormalizer->normalize($jsonData->gemeente),
            $streetNameNormalizer->normalize($jsonData->straatnaam),
            $addressDetail,
            (float) $jsonData->score
        );
    }
}
