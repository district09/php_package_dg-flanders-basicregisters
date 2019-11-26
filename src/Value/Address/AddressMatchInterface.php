<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Value\Address;

use DigipolisGent\Flanders\BasicRegisters\Value\Municipality\MunicipalityName;
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
     * Get the related MunicipalityName value.
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\Municipality\MunicipalityName
     */
    public function municipalityName(): MunicipalityName;

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
