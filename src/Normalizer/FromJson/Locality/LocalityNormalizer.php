<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\Locality;

use DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\IdExtractor;
use DigipolisGent\Flanders\BasicRegisters\Value\Locality\Locality;
use DigipolisGent\Flanders\BasicRegisters\Value\Post\PostInfoId;

/**
 * Normalizes json data into a Locality value.
 */
class LocalityNormalizer
{
    /**
     * Normalize json data into a Locality value.
     *
     * @param object $jsonData
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\Locality\Locality
     */
    public function normalize(object $jsonData): Locality
    {
        $idExtractor = new IdExtractor();
        $localityNameNormalizer = new LocalityNameNormalizer();

        return new Locality(
            new PostInfoId($idExtractor->extractObjectId($jsonData->postinfo)),
            $localityNameNormalizer->normalize($jsonData->gemeente)
        );
    }
}
