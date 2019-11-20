<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Value\Address;

use DigipolisGent\Flanders\BasicRegisters\Value\Locality\LocalityName;
use DigipolisGent\Flanders\BasicRegisters\Value\Street\StreetName;
use DigipolisGent\Value\ValueInterface;

/**
 * Result of an AddressMatch request.
 *
 * Addresses can be looked up using an AddressMatch request. Each found match
 * gets a score how close it matches the request.
 */
interface AddressMatchInterface extends ValueInterface
{
    /**
     * Get the related LocalityName value.
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\Locality\LocalityName
     */
    public function localityName(): LocalityName;

    /**
     * Get the related StreetName value.
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\Street\StreetName
     */
    public function streetName(): StreetName;

    /**
     * Has the match a complete address.
     *
     * @return bool
     */
    public function hasAddressDetail(): bool;

    /**
     * Get the address detail (if any).
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\Address\AddressDetailInterface|null
     */
    public function addressDetail(): ?AddressDetailInterface;

    /**
     * Get the matching score.
     *
     * @return float
     */
    public function score(): float;
}
