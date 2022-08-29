<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\Municipality;

use DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\IdExtractor;
use DigipolisGent\Flanders\BasicRegisters\Value\Municipality\Municipality;
use DigipolisGent\Flanders\BasicRegisters\Value\Post\PostInfoId;

/**
 * Normalizes json data into a Municipality value.
 */
class MunicipalityNormalizer
{
    /**
     * Normalize json data.
     *
     * @param object $jsonData
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\Municipality\Municipality
     */
    public function normalize(object $jsonData): Municipality
    {
        $idExtractor = new IdExtractor();

        return new Municipality(
            new PostInfoId($idExtractor->extractObjectId($jsonData->postinfo)),
            (new MunicipalityNameNormalizer())->normalize($jsonData->gemeente)
        );
    }
}
