<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\Post;

use DigipolisGent\Flanders\BasicRegisters\Value\Post\PostInfos;

/**
 * Normalizes JSON data into a PostInfos collection.
 */
final class PostInfosNormalizer
{
    /**
     * Normalize json data.
     *
     * @param object $jsonData
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\Post\PostInfos
     */
    public function normalize(object $jsonData): PostInfos
    {
        $postInfoNormalizer = new PostInfoNormalizer();

        $postInfos = [];
        foreach ($jsonData->postInfoObjecten as $postInfoData) {
            $postInfos[] = $postInfoNormalizer->normalize($postInfoData);
        }

        return new PostInfos(...$postInfos);
    }
}
