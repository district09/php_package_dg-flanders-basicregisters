<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters;

use DigipolisGent\Flanders\BasicRegisters\Value\Address\Addresses;

/**
 * Service to access the Flanders Basic register service.
 */
interface BasicRegistersInterface
{
    /**
     * Get a list of addresses
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\Address\Addresses
     *   Collection of found addresses.
     */
    public function addressList(): Addresses;
}
