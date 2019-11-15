<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Value;

use DigipolisGent\Value\CollectionAbstract;

/**
 * Collection of post info.
 */
final class PostInfos extends CollectionAbstract
{
    /**
     * Create a new collection.
     *
     * @param \DigipolisGent\Flanders\BasicRegisters\Value\PostInfo ...$postInfos
     *   One or more addresses.
     */
    public function __construct(PostInfo ...$postInfos)
    {
        $this->values = $postInfos;
    }

    /**
     * @inheritDoc
     */
    public function __toString(): string
    {
        $postInfos = [];

        /** @var \DigipolisGent\Flanders\BasicRegisters\Value\PostInfo $postInfo */
        foreach ($this->values as $postInfo) {
            $postInfos[] = (string) $postInfo;
        }

        return implode(', ', $postInfos);
    }
}
