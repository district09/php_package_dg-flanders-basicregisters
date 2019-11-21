<?php

namespace DigipolisGent\Flanders\BasicRegisters;

use DigipolisGent\API\Client\ClientInterface;
use DigipolisGent\Flanders\BasicRegisters\Filter\FiltersInterface;
use DigipolisGent\Flanders\BasicRegisters\Pager\PagerInterface;
use DigipolisGent\Flanders\BasicRegisters\Request\AddressDetailRequest;
use DigipolisGent\Flanders\BasicRegisters\Request\AddressListRequest;
use DigipolisGent\Flanders\BasicRegisters\Request\AddressMatchRequest;
use DigipolisGent\Flanders\BasicRegisters\Request\MunicipalityNameDetailRequest;
use DigipolisGent\Flanders\BasicRegisters\Request\MunicipalityNamesRequest;
use DigipolisGent\Flanders\BasicRegisters\Value\Address\AddressDetailInterface;
use DigipolisGent\Flanders\BasicRegisters\Value\Address\Addresses;
use DigipolisGent\Flanders\BasicRegisters\Value\Address\AddressId;
use DigipolisGent\Flanders\BasicRegisters\Value\Address\AddressMatches;
use DigipolisGent\Flanders\BasicRegisters\Value\Municipality\MunicipalityNameDetailInterface;
use DigipolisGent\Flanders\BasicRegisters\Value\Municipality\MunicipalityNameId;
use DigipolisGent\Flanders\BasicRegisters\Value\Municipality\MunicipalityNames;

/**
 * Service to access the Flanders Basic register service.
 */
final class BasicRegisters implements BasicRegistersInterface
{

    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * Create a new lodging service by injecting the client.
     *
     * @param \DigipolisGent\API\Client\ClientInterface $client
     */
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @inheritDoc
     */
    public function addressList(?FiltersInterface $filters = null, ?PagerInterface $pager = null): Addresses
    {
        $request = new AddressListRequest($filters, $pager);
        return $this->client->send($request)->addresses();
    }

    /**
     * @inheritDoc
     */
    public function addressDetail(AddressId $addressId): AddressDetailInterface
    {
        $request = new AddressDetailRequest($addressId);
        return $this->client->send($request)->addressDetail();
    }

    /**
     * @inheritDoc
     */
    public function addressMatch(FiltersInterface $filters = null): AddressMatches
    {
        $request = new AddressMatchRequest($filters);
        return $this->client->send($request)->addressMatches();
    }

    /**
     * @inheritDoc
     */
    public function municipalityNames(PagerInterface $pager = null): MunicipalityNames
    {
        $request = new MunicipalityNamesRequest($pager);
        return $this->client->send($request)->municipalityNames();
    }

    /**
     * @inheritDoc
     */
    public function municipalityNameDetail(MunicipalityNameId $municipalityNameId): MunicipalityNameDetailInterface
    {
        $request = new MunicipalityNameDetailRequest($municipalityNameId);
        return $this->client->send($request)->municipalityNameDetail();
    }
}
