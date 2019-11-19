<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters;

use DigipolisGent\Flanders\BasicRegisters\Filter\Filters;
use DigipolisGent\Flanders\BasicRegisters\Pager\Pager;
use DigipolisGent\Flanders\BasicRegisters\Value\Address\AddressDetailInterface;
use DigipolisGent\Flanders\BasicRegisters\Value\Address\Addresses;
use DigipolisGent\Flanders\BasicRegisters\Value\Address\AddressId;

/**
 * Service to access the Flanders Basic register service.
 */
interface BasicRegistersInterface
{
    /**
     * Get a list of addresses
     *
     * @param \DigipolisGent\Flanders\BasicRegisters\Filter\Filters|null $filters
     *   Optional filters to limit the returned addresses by.
     * @param \DigipolisGent\Flanders\BasicRegisters\Pager\Pager|null $pager
     *   Optional pager.
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\Address\Addresses
     *   Collection of found addresses.
     */
    public function addressList(?Filters $filters = null, ?Pager $pager = null): Addresses;

    /**
     * Get the address details by a given AddressId value.
     *
     * @param \DigipolisGent\Flanders\BasicRegisters\Value\Address\AddressId $addressId
     *   The address id to get the details for.
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\Address\AddressDetailInterface
     *   The address detail value.
     */
    public function addressDetail(AddressId $addressId): AddressDetailInterface;
}
