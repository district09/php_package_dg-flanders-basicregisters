<?php

namespace DigipolisGent\Flanders\BasicRegisters;

use DigipolisGent\API\Client\ClientInterface;
use DigipolisGent\Flanders\BasicRegisters\Filter\Filters;
use DigipolisGent\Flanders\BasicRegisters\Pager\Pager;
use DigipolisGent\Flanders\BasicRegisters\Request\AddressDetailRequest;
use DigipolisGent\Flanders\BasicRegisters\Request\AddressListRequest;
use DigipolisGent\Flanders\BasicRegisters\Value\Address\AddressDetailInterface;
use DigipolisGent\Flanders\BasicRegisters\Value\Address\Addresses;
use DigipolisGent\Flanders\BasicRegisters\Value\Address\AddressId;

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
    public function addressList(?Filters $filters = null, ?Pager $pager = null): Addresses
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
}
