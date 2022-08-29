<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\Post;

use DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\Geographical\GeographicalNameNormalizer;
use DigipolisGent\Flanders\BasicRegisters\Value\Post\PostInfoNames;

/**
 * Normalizes the post info names.
 */
class PostInfoNamesNormalizer
{
    /**
     * Normalize json data.
     *
     * @param array $jsonData
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\Post\PostInfoNames
     */
    public function normalize(array $jsonData): PostInfoNames
    {
        $nameNormalizer = new GeographicalNameNormalizer();

        $geographicalNames = [];
        foreach ($jsonData as $item) {
            $geographicalNames[] = $nameNormalizer->normalize($item->geografischeNaam);
        }

        return new PostInfoNames(...$geographicalNames);
    }
}
