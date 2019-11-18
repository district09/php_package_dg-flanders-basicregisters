<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\Address;

use DigipolisGent\Flanders\BasicRegisters\Value\Address\AddressMatch;

/**
 * Normalizes json data into AddressMatch value.
 */
class AddressMatchNormalizer
{
    /**
     * Normalize the json data into an AddressMatch value.
     *
     * @param object $jsonData
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\Address\AddressMatch
     */
    public function normalize(object $jsonData): AddressMatch
    {
        $addressDetailNormalizer = new AddressDetailNormalizer();

        return new AddressMatch(
            $addressDetailNormalizer->normalize($jsonData),
            (float) $jsonData->score
        );
    }
}
