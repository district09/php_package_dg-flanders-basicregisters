<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Value\Post;

use DigipolisGent\Value\CollectionAbstract;

/**
 * Collection of post info.
 */
final class PostInfos extends CollectionAbstract
{
    /**
     * Create a new collection.
     *
     * @param \DigipolisGent\Flanders\BasicRegisters\Value\Post\PostInfoInterface ...$postInfos
     *   One or more post info.
     */
    public function __construct(PostInfoInterface ...$postInfos)
    {
        $this->values = $postInfos;
    }

    /**
     * @inheritDoc
     */
    public function __toString(): string
    {
        $postInfos = [];

        /** @var \DigipolisGent\Flanders\BasicRegisters\Value\Post\PostInfoInterface $postInfo */
        foreach ($this->values as $postInfo) {
            $postInfos[] = (string) $postInfo;
        }

        return implode(', ', $postInfos);
    }
}
