<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\Address;

use DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\Municipality\MunicipalityNormalizer;
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
        return new AddressDetail(
            (new AddressNormalizer())->normalize($jsonData),
            (new MunicipalityNormalizer())->normalize($jsonData),
            (new StreetNameNormalizer())->normalize($jsonData->straatnaam),
            (new Lambert72PointNormalizer())->normalize($jsonData->adresPositie->geometrie)
        );
    }
}
