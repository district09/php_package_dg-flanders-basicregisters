<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Service;

use DigipolisGent\API\Client\ClientInterface;
use DigipolisGent\API\Client\Response\ResponseInterface;
use DigipolisGent\Flanders\BasicRegisters\Service\AddressService;
use DigipolisGent\Flanders\BasicRegisters\Filter\FiltersInterface;
use DigipolisGent\Flanders\BasicRegisters\Pager\PagerInterface;
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
use Psr\Http\Message\RequestInterface;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Service\AddressService
 */
class AddressServiceTest extends TestCase
{
    /**
     * Get the list of addresses.
     *
     * @test
     */
    public function listReturnsAddressesCollection(): void
    {
        $filters = $this->createFiltersMock();
        $pager = $this->createPagerMock();

        $addresses = new Addresses();
        $request = new AddressListRequest($filters, $pager);
        $response = new AddressListResponse($addresses);

        $address = new AddressService(
            $this->createClientMock($request, $response)
        );

        $this->assertEquals(
            $addresses,
            $address->list($filters, $pager)
        );
    }

    /**
     * Get the address details for a given Address ID.
     *
     * @test
     */
    public function detailReturnsAddressDetailsValue(): void
    {
        $addressId = new AddressId(9731);
        $addressDetail = $this->prophesize(AddressDetailInterface::class)->reveal();
        $request = new AddressDetailRequest($addressId);
        $response = new AddressDetailResponse($addressDetail);

        $address = new AddressService(
            $this->createClientMock($request, $response)
        );

        $this->assertEquals(
            $addressDetail,
            $address->detail($addressId)
        );
    }

    /**
     * Get the list of matching addresses.
     *
     * @test
     */
    public function matchReturnsAddressMatchesCollection(): void
    {
        $filters = $this->createFiltersMock();

        $addressMatches = new AddressMatches();
        $request = new AddressMatchRequest($filters);
        $response = new AddressMatchResponse($addressMatches);

        $address = new AddressService(
            $this->createClientMock($request, $response)
        );

        $this->assertEquals(
            $addressMatches,
            $address->match($filters)
        );
    }

    /**
     * Create a client mock.
     *
     * @param \Psr\Http\Message\RequestInterface $request
     * @param \DigipolisGent\API\Client\Response\ResponseInterface $response
     *
     * @return \DigipolisGent\API\Client\ClientInterface
     */
    private function createClientMock(RequestInterface $request, ResponseInterface $response): ClientInterface
    {
        $client = $this->prophesize(ClientInterface::class);
        $client->send($request)->willReturn($response);

        return $client->reveal();
    }

    /**
     * Create empty filters mock.
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Filter\FiltersInterface
     */
    private function createFiltersMock(): FiltersInterface
    {
        $filtersMock = $this->prophesize(FiltersInterface::class);
        $filtersMock->filters()->willReturn([]);

        return $filtersMock->reveal();
    }

    /**
     * Create empty pager mock.
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Pager\PagerInterface
     */
    private function createPagerMock(): PagerInterface
    {
        $pagerMock = $this->prophesize(PagerInterface::class);
        $pagerMock->query()->willReturn([]);

        return $pagerMock->reveal();
    }
}
