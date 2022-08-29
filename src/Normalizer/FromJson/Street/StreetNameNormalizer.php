<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\Street;

use DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\Geographical\GeographicalNameNormalizer;
use DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\IdExtractor;
use DigipolisGent\Flanders\BasicRegisters\Value\Street\StreetName;
use DigipolisGent\Flanders\BasicRegisters\Value\Street\StreetNameId;

/**
 * Normalizes JSON data into a StreetName object.
 */
final class StreetNameNormalizer
{
    /**
     * Normalize json data.
     *
     * @param object $jsonData
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\Street\StreetName
     */
    public function normalize(object $jsonData): StreetName
    {
        $idExtractor = new IdExtractor();
        $nameNormalizer = new GeographicalNameNormalizer();

        return new StreetName(
            new StreetNameId($idExtractor->extractObjectId($jsonData)),
            $nameNormalizer->normalize($jsonData->straatnaam->geografischeNaam)
        );
    }
}
