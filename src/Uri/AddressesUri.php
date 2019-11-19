<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Uri;

use DigipolisGent\API\Client\Uri\UriInterface;

/**
 * Uri where the addresses (adressen) methods are located.
 */
class AddressesUri implements UriInterface
{

    /**
     * @inheritDoc
     */
    public function getUri()
    {
        return 'adressen';
    }
}
