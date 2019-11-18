<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\Address;

use DigipolisGent\Flanders\BasicRegisters\Value\Address\AddressMatches;

/**
 * Normalizes json data into an AddressMatches collection.
 */
class AddressMatchesNormalizer
{
    /**
     * Normalize the json data.
     *
     * @param object $jsonData
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\Address\AddressMatches
     */
    public function normalize(object $jsonData): AddressMatches
    {
        $addressMatchNormalizer = new AddressMatchNormalizer();

        $addressMatches = [];
        foreach ($jsonData->adresMatches as $addressMatchData) {
            $addressMatches[] = $addressMatchNormalizer->normalize($addressMatchData);
        }

        return new AddressMatches(...$addressMatches);
    }
}
