<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters;

use DigipolisGent\API\Client\ClientInterface;
use DigipolisGent\Flanders\BasicRegisters\BasicRegisters;
use DigipolisGent\Flanders\BasicRegisters\Filter\FiltersInterface;
use DigipolisGent\Flanders\BasicRegisters\Request\AddressDetailRequest;
use DigipolisGent\Flanders\BasicRegisters\Request\AddressListRequest;
use DigipolisGent\Flanders\BasicRegisters\Request\AddressMatchRequest;
use DigipolisGent\Flanders\BasicRegisters\Response\AddressDetailResponse;
use DigipolisGent\Flanders\BasicRegisters\Response\AddressListResponse;
use DigipolisGent\Flanders\BasicRegisters\Response\AddressMatchResponse;
use DigipolisGent\Flanders\BasicRegisters\Value\Address\AddressDetailInterface;
use DigipolisGent\Flanders\BasicRegisters\Value\Address\Addresses;
use DigipolisGent\Flanders\BasicRegisters\Value\Address\AddressId;
use DigipolisGent\Flanders\BasicRegisters\Value\Address\AddressMatches;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\BasicRegisters
 */
class BasicRegistersTest extends TestCase
{
    /**
     * Get the list of addresses.
     *
     * @test
     */
    public function getAddressList(): void
    {
        $addresses = new Addresses();
        $request = new AddressListRequest();
        $response = new AddressListResponse($addresses);

        $client = $this->prophesize(ClientInterface::class);
        $client->send($request)->willReturn($response);

        $basicRegisters = new BasicRegisters($client->reveal());

        $this->assertEquals($addresses, $basicRegisters->addressList());
    }

    /**
     * Get the address details for a given Address ID.
     *
     * @test
     */
    public function getAddressDetail(): void
    {
        $addressId = new AddressId(9731);
        $addressDetail = $this->prophesize(AddressDetailInterface::class)->reveal();
        $request = new AddressDetailRequest($addressId);
        $response = new AddressDetailResponse($addressDetail);

        $client = $this->prophesize(ClientInterface::class);
        $client->send($request)->willReturn($response);

        $basicRegisters = new BasicRegisters($client->reveal());

        $this->assertEquals($addressDetail, $basicRegisters->addressDetail($addressId));
    }

    /**
     * Get the list of matching addresses.
     *
     * @test
     */
    public function getAddressMatch(): void
    {
        $filtersMock = $this->prophesize(FiltersInterface::class);
        $filtersMock->filters()->willReturn([]);
        $filters = $filtersMock->reveal();

        $addressMatches = new AddressMatches();
        $request = new AddressMatchRequest($filters);
        $response = new AddressMatchResponse($addressMatches);

        $client = $this->prophesize(ClientInterface::class);
        $client->send($request)->willReturn($response);

        $basicRegisters = new BasicRegisters($client->reveal());

        $this->assertEquals($addressMatches, $basicRegisters->addressMatch($filters));
    }
}
