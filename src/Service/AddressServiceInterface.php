<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Service;

use DigipolisGent\Flanders\BasicRegisters\Filter\FiltersInterface;
use DigipolisGent\Flanders\BasicRegisters\Pager\PagerInterface;
use DigipolisGent\Flanders\BasicRegisters\Value\Address\AddressDetailInterface;
use DigipolisGent\Flanders\BasicRegisters\Value\Address\Addresses;
use DigipolisGent\Flanders\BasicRegisters\Value\Address\AddressId;
use DigipolisGent\Flanders\BasicRegisters\Value\Address\AddressMatches;

/**
 * Service to access the Flanders Basic register service address methods.
 */
interface AddressServiceInterface extends ServiceInterface
{
    /**
     * Get a list of addresses
     *
     * @param \DigipolisGent\Flanders\BasicRegisters\Filter\FiltersInterface|null $filters
     *   Optional filters to limit the returned addresses by.
     * @param \DigipolisGent\Flanders\BasicRegisters\Pager\PagerInterface|null $pager
     *   Optional pager.
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\Address\Addresses
     *   Collection of found addresses.
     */
    public function list(?FiltersInterface $filters = null, ?PagerInterface $pager = null): Addresses;

    /**
     * Get the address details by a given AddressId value.
     *
     * @param \DigipolisGent\Flanders\BasicRegisters\Value\Address\AddressId $addressId
     *   The address id to get the details for.
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\Address\AddressDetailInterface
     *   The address detail value.
     */
    public function detail(AddressId $addressId): AddressDetailInterface;

    /**
     * Look up addresses that match (partial) filter values.
     *
     * NOTE: The matcher requires that minimal following filters are provided:
     *   (MunicipalityName AND/OR MunicipalityNisCode AND/OR PostalCode)
     *   AND
     *   (StreetName AND/OR StreetPatrimonyCode AND/OR StreetNationalRegisterCode)
     *
     * @param \DigipolisGent\Flanders\BasicRegisters\Filter\FiltersInterface $filters
     *   Optional filters to limit the returned addresses by.
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\Address\AddressMatches
     *   The matching addresses.
     */
    public function match(FiltersInterface $filters = null): AddressMatches;
}
