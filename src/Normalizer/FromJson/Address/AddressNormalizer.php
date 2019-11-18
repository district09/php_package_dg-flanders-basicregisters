<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\Address;

use DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\IdExtractor;
use DigipolisGent\Flanders\BasicRegisters\Value\Address\Address;
use DigipolisGent\Flanders\BasicRegisters\Value\Address\AddressId;

/**
 * Normalizes JSON data into an Address value.
 */
final class AddressNormalizer
{
    /**
     * Normalize the given json object into an Address value.
     *
     * @param object $jsonData
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\Address\Address
     */
    public function normalize(object $jsonData): Address
    {
        $idExtractor = new IdExtractor();
        $fullAddressNormalizer = new FullAddressNormalizer();

        return new Address(
            new AddressId($idExtractor->extractObjectId($jsonData)),
            $jsonData->huisnummer,
            $jsonData->busnummer,
            $fullAddressNormalizer->normalize($jsonData->volledigAdres)
        );
    }
}
