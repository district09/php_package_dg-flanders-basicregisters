<?php

namespace DigipolisGent\Flanders\BasicRegisters\Service;

use DigipolisGent\API\Service\ServiceAbstract;
use DigipolisGent\Flanders\BasicRegisters\Filter\FiltersInterface;
use DigipolisGent\Flanders\BasicRegisters\Pager\PagerInterface;
use DigipolisGent\Flanders\BasicRegisters\Request\AddressDetailRequest;
use DigipolisGent\Flanders\BasicRegisters\Request\AddressListRequest;
use DigipolisGent\Flanders\BasicRegisters\Request\AddressMatchRequest;
use DigipolisGent\Flanders\BasicRegisters\Value\Address\AddressDetailInterface;
use DigipolisGent\Flanders\BasicRegisters\Value\Address\Addresses;
use DigipolisGent\Flanders\BasicRegisters\Value\Address\AddressId;
use DigipolisGent\Flanders\BasicRegisters\Value\Address\AddressMatches;

/**
 * Service to access the Flanders Basic register service address methods.
 */
final class AddressService extends ServiceAbstract implements AddressServiceInterface
{
    /**
     * @inheritDoc
     */
    public function list(?FiltersInterface $filters = null, ?PagerInterface $pager = null): Addresses
    {
        $request = new AddressListRequest($filters, $pager);
        return $this->client()->send($request)->addresses();
    }

    /**
     * @inheritDoc
     */
    public function detail(AddressId $addressId): AddressDetailInterface
    {
        $request = new AddressDetailRequest($addressId);
        return $this->client()->send($request)->addressDetail();
    }

    /**
     * @inheritDoc
     */
    public function match(FiltersInterface $filters = null): AddressMatches
    {
        $request = new AddressMatchRequest($filters);
        return $this->client()->send($request)->addressMatches();
    }
}
