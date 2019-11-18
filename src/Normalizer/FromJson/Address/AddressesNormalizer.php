<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\Address;

use DigipolisGent\Flanders\BasicRegisters\Value\Address\Addresses;

/**
 * Normalizes JSON data into an Addresses collection.
 */
final class AddressesNormalizer
{
    /**
     * Normalize the json data.
     *
     * @param object $jsonData
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\Address\Addresses
     */
    public function normalize(object $jsonData): Addresses
    {
        $addressNormalizer = new AddressNormalizer();

        $addresses = [];
        foreach ($jsonData->adressen as $addressData) {
            $addresses[] = $addressNormalizer->normalize($addressData);
        }

        return new Addresses(...$addresses);
    }
}
