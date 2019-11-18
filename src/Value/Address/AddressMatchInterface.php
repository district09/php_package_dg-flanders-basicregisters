<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Value\Address;

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
     * Get the address id.
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\Address\AddressId
     */
    public function addressId(): AddressId;

    /**
     * Get the address detail.
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\Address\AddressDetailInterface
     */
    public function addressDetail(): AddressDetailInterface;

    /**
     * Get the matching score.
     *
     * @return float
     */
    public function score(): float;
}
