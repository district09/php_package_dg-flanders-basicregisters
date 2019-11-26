<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Uri;

/**
 * Uri where the PostInfo method is located.
 */
class PostInfoListUri extends AbstractUriWithQuery
{
    /**
     * @inheritDoc
     */
    protected function getPath(): string
    {
        return 'postinfo';
    }
}
