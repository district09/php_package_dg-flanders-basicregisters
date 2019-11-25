<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Uri;

/**
 * Uri where the addresses (adressen) methods are located.
 */
class AddressListUri extends AbstractUriWithQuery
{
    /**
     * @inheritDoc
     */
    protected function getPath(): string
    {
        return 'adressen';
    }
}
