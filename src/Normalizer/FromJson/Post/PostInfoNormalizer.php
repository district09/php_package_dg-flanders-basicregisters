<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\Post;

use DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\IdExtractor;
use DigipolisGent\Flanders\BasicRegisters\Value\Post\PostInfo;
use DigipolisGent\Flanders\BasicRegisters\Value\Post\PostInfoId;
use DigipolisGent\Flanders\BasicRegisters\Value\Post\PostInfoInterface;

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
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\Post\PostInfoInterface
     */
    public function normalize(object $jsonData): PostInfoInterface
    {
        $idExtractor = new IdExtractor();

        return new PostInfo(
            new PostInfoId($idExtractor->extractObjectId($jsonData)),
            (new PostInfoNamesNormalizer())->normalize($jsonData->postnamen)
        );
    }
}
