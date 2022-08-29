<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\Address;

use DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\Municipality\MunicipalityNameNormalizer;
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
        $addressDetail = null;
        if (!empty($jsonData->identificator)) {
            $detailNormalizer = new AddressDetailNormalizer();
            $addressDetail = $detailNormalizer->normalize($jsonData);
        }

        return new AddressMatch(
            (new MunicipalityNameNormalizer())->normalize($jsonData->gemeente),
            (new StreetNameNormalizer())->normalize($jsonData->straatnaam),
            $addressDetail,
            (float) $jsonData->score
        );
    }
}
