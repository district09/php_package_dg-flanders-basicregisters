<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Uri;

/**
 * Uri where the street names (streetnamen) method is located.
 */
class StreetNameListUri extends AbstractUriWithQuery
{
    /**
     * @inheritDoc
     */
    protected function getPath(): string
    {
        return 'straatnamen';
    }
}
