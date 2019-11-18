<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\Address;

use DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\Locality\LocalityNormalizer;
use DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\Position\Lambert72PointNormalizer;
use DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\Street\StreetNameNormalizer;
use DigipolisGent\Flanders\BasicRegisters\Value\Address\AddressDetail;

/**
 * Normalizes JSON data into an AddressDetail value.
 */
final class AddressDetailNormalizer
{
    /**
     * Normalize json data.
     *
     * @param object $jsonData
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\Address\AddressDetail
     */
    public function normalize(object $jsonData): AddressDetail
    {
        $addressNormalizer = new AddressNormalizer();
        $localityNormalizer = new LocalityNormalizer();
        $streetNameNormalizer = new StreetNameNormalizer();
        $positionNormalizer = new Lambert72PointNormalizer();

        return new AddressDetail(
            $addressNormalizer->normalize($jsonData),
            $localityNormalizer->normalize($jsonData),
            $streetNameNormalizer->normalize($jsonData->straatnaam),
            $positionNormalizer->normalize($jsonData->adresPositie->point)
        );
    }
}
