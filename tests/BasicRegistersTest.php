<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters;

use DigipolisGent\API\Client\ClientInterface;
use DigipolisGent\API\Client\Response\ResponseInterface;
use DigipolisGent\Flanders\BasicRegisters\BasicRegisters;
use DigipolisGent\Flanders\BasicRegisters\Filter\FiltersInterface;
use DigipolisGent\Flanders\BasicRegisters\Pager\PagerInterface;
use DigipolisGent\Flanders\BasicRegisters\Request\AddressDetailRequest;
use DigipolisGent\Flanders\BasicRegisters\Request\AddressListRequest;
use DigipolisGent\Flanders\BasicRegisters\Request\AddressMatchRequest;
use DigipolisGent\Flanders\BasicRegisters\Request\MunicipalityNameDetailRequest;
use DigipolisGent\Flanders\BasicRegisters\Request\MunicipalityNamesRequest;
use DigipolisGent\Flanders\BasicRegisters\Response\AddressDetailResponse;
use DigipolisGent\Flanders\BasicRegisters\Response\AddressListResponse;
use DigipolisGent\Flanders\BasicRegisters\Response\AddressMatchResponse;
use DigipolisGent\Flanders\BasicRegisters\Response\MunicipalityNameDetailResponse;
use DigipolisGent\Flanders\BasicRegisters\Response\MunicipalityNamesResponse;
use DigipolisGent\Flanders\BasicRegisters\Value\Address\AddressDetailInterface;
use DigipolisGent\Flanders\BasicRegisters\Value\Address\Addresses;
use DigipolisGent\Flanders\BasicRegisters\Value\Address\AddressId;
use DigipolisGent\Flanders\BasicRegisters\Value\Address\AddressMatches;
use DigipolisGent\Flanders\BasicRegisters\Value\Municipality\MunicipalityNameDetailInterface;
use DigipolisGent\Flanders\BasicRegisters\Value\Municipality\MunicipalityNameId;
use DigipolisGent\Flanders\BasicRegisters\Value\Municipality\MunicipalityNames;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestInterface;

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
        $filters = $this->createFiltersMock();
        $pager = $this->createPagerMock();

        $addresses = new Addresses();
        $request = new AddressListRequest($filters, $pager);
        $response = new AddressListResponse($addresses);

        $basicRegisters = new BasicRegisters(
            $this->createClientMock($request, $response)
        );

        $this->assertEquals($addresses, $basicRegisters->addressList($filters, $pager));
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

        $basicRegisters = new BasicRegisters(
            $this->createClientMock($request, $response)
        );

        $this->assertEquals($addressDetail, $basicRegisters->addressDetail($addressId));
    }

    /**
     * Get the list of matching addresses.
     *
     * @test
     */
    public function getAddressMatch(): void
    {
        $filters = $this->createFiltersMock();

        $addressMatches = new AddressMatches();
        $request = new AddressMatchRequest($filters);
        $response = new AddressMatchResponse($addressMatches);

        $basicRegisters = new BasicRegisters(
            $this->createClientMock($request, $response)
        );

        $this->assertEquals($addressMatches, $basicRegisters->addressMatch($filters));
    }

    /**
     * Get the list of municipality names.
     *
     * @test
     */
    public function getMunicipalityNames(): void
    {
        $pager = $this->createPagerMock();

        $municipalityNames = new MunicipalityNames();
        $request = new MunicipalityNamesRequest($pager);
        $response = new MunicipalityNamesResponse($municipalityNames);

        $basicRegisters = new BasicRegisters(
            $this->createClientMock($request, $response)
        );

        $this->assertEquals($municipalityNames, $basicRegisters->municipalityNames($pager));
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

    /**
     * Get the municipality name details for a given municipality name ID.
     *
     * @test
     */
    public function getMunicipalityNameDetail(): void
    {
        $municipalityNameId = new MunicipalityNameId(9731);
        $municipalityNameDetail = $this->prophesize(MunicipalityNameDetailInterface::class)->reveal();

        $request = new MunicipalityNameDetailRequest($municipalityNameId);
        $response = new MunicipalityNameDetailResponse($municipalityNameDetail);

        $basicRegisters = new BasicRegisters(
            $this->createClientMock($request, $response)
        );

        $this->assertEquals(
            $municipalityNameDetail,
            $basicRegisters->municipalityNameDetail($municipalityNameId)
        );
    }
}
