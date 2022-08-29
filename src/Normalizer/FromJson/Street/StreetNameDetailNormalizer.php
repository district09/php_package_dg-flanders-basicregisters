<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\Street;

use DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\Geographical\GeographicalNamesNormalizer;
use DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\IdExtractor;
use DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\Municipality\MunicipalityNameNormalizer;
use DigipolisGent\Flanders\BasicRegisters\Value\Street\StreetNameDetail;
use DigipolisGent\Flanders\BasicRegisters\Value\Street\StreetNameDetailInterface;
use DigipolisGent\Flanders\BasicRegisters\Value\Street\StreetNameId;

/**
 * Normalizes JSON data into a StreetNameDetailInterface value.
 */
final class StreetNameDetailNormalizer
{
    /**
     * Normalize the json data
     *
     * @param object $jsonData
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\Street\StreetNameDetailInterface
     */
    public function normalize(object $jsonData): StreetNameDetailInterface
    {
        $idExtractor = new IdExtractor();

        return new StreetNameDetail(
            new StreetNameId($idExtractor->extractObjectId($jsonData)),
            (new GeographicalNamesNormalizer())->normalize($jsonData->straatnamen),
            (new MunicipalityNameNormalizer())->normalize($jsonData->gemeente)
        );
    }
}
