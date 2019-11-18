<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\Geographical;

use DigipolisGent\Flanders\BasicRegisters\Value\Address\FullAddress;
use DigipolisGent\Flanders\BasicRegisters\Value\LanguageCode;

/**
 * Normalizes json data into a FullAddress value.
 */
final class FullAddressNormalizer
{
    /**
     * Normalize the json data.
     *
     * @param object $jsonData
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\Address\FullAddress
     */
    public function normalize(object $jsonData): FullAddress
    {
        return new FullAddress(
            new LanguageCode($jsonData->geografischeNaam->taal),
            $jsonData->geografischeNaam->spelling
        );
    }
}
