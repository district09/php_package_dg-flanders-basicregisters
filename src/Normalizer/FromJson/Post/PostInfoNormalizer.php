<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\Post;

use DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\Geographical\GeographicalNamesNormalizer;
use DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\IdExtractor;
use DigipolisGent\Flanders\BasicRegisters\Value\Geographical\GeographicalNames;
use DigipolisGent\Flanders\BasicRegisters\Value\Post\PostInfo;
use DigipolisGent\Flanders\BasicRegisters\Value\Post\PostInfoId;

/**
 * Normalizes JSON data into a PostInfo value.
 */
final class PostInfoNormalizer
{
    /**
     * Normalize json data.
     *
     * @param object $jsonData
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\Post\PostInfo
     */
    public function normalize(object $jsonData): PostInfo
    {
        $idExtractor = new IdExtractor();

        return new PostInfo(
            new PostInfoId($idExtractor->extractObjectId($jsonData)),
            $this->extractPostGeographicalNames($jsonData)
        );
    }

    /**
     * Extract the post geographical names from the json data.
     *
     * @param object $jsonData
     *
     * @return GeographicalNames
     */
    private function extractPostGeographicalNames(object $jsonData): GeographicalNames
    {
        $postNames = [];
        foreach ($jsonData->postnamen as $wrapper) {
            $postNames[] = $wrapper->geografischeNaam;
        }

        $geoGraphicalNamesNormalizer = new GeographicalNamesNormalizer();
        return $geoGraphicalNamesNormalizer->normalize($postNames);
    }
}
