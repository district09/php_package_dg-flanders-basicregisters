<?php

namespace DigipolisGent\Flanders\BasicRegisters\Service;

use DigipolisGent\API\Service\ServiceAbstract;
use DigipolisGent\Flanders\BasicRegisters\Cache\CacheKey;
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

        /** @var \DigipolisGent\Flanders\BasicRegisters\Response\AddressListResponse $response */
        $response = $this->client()->send($request);
        return $response->addresses();
    }

    /**
     * @inheritDoc
     */
    public function detail(AddressId $addressId): AddressDetailInterface
    {
        $cacheKey = CacheKey::fromId($addressId)->value();

        $detail = $this->cacheGet($cacheKey);
        if (!$detail) {
            $request = new AddressDetailRequest($addressId);
            /** @var \DigipolisGent\Flanders\BasicRegisters\Response\AddressDetailResponse $response */
            $response = $this->client()->send($request);
            $detail = $response->addressDetail();
            $this->cacheSet($cacheKey, $detail);
        }

        return $detail;
    }

    /**
     * @inheritDoc
     */
    public function match(FiltersInterface $filters = null): AddressMatches
    {
        $request = new AddressMatchRequest($filters);

        /** @var \DigipolisGent\Flanders\BasicRegisters\Response\AddressMatchResponse $response */
        $response = $this->client()->send($request);
        return $response->addressMatches();
    }
}
