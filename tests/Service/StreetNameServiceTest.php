<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Service;

use DigipolisGent\API\Client\ClientInterface;
use DigipolisGent\API\Client\Response\ResponseInterface;
use DigipolisGent\Flanders\BasicRegisters\Request\StreetNameDetailRequest;
use DigipolisGent\Flanders\BasicRegisters\Request\StreetNameListRequest;
use DigipolisGent\Flanders\BasicRegisters\Response\StreetNameDetailResponse;
use DigipolisGent\Flanders\BasicRegisters\Response\StreetNameListResponse;
use DigipolisGent\Flanders\BasicRegisters\Filter\FiltersInterface;
use DigipolisGent\Flanders\BasicRegisters\Pager\PagerInterface;
use DigipolisGent\Flanders\BasicRegisters\Service\StreetNameService;
use DigipolisGent\Flanders\BasicRegisters\Value\Street\StreetNameDetailInterface;
use DigipolisGent\Flanders\BasicRegisters\Value\Street\StreetNameId;
use DigipolisGent\Flanders\BasicRegisters\Value\Street\StreetNames;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestInterface;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Service\StreetNameService
 */
class StreetNameServiceTest extends TestCase
{
    /**
     * Get the list of street names.
     *
     * @test
     */
    public function listReturnsStreetNamesCollection(): void
    {
        $filters = $this->createFiltersMock();
        $pager = $this->createPagerMock();

        $streetNames = new StreetNames();
        $request = new StreetNameListRequest($filters, $pager);
        $response = new StreetNameListResponse($streetNames);

        $streetNameService = new StreetNameService(
            $this->createClientMock($request, $response)
        );

        $this->assertEquals(
            $streetNames,
            $streetNameService->list($filters, $pager)
        );
    }

    /**
     * Get the street name details for a given StreetNameId.
     *
     * @test
     */
    public function detailReturnsStreetNameDetailValue(): void
    {
        $streetNameId = new StreetNameId(9731);
        $streetNameDetail = $this->prophesize(StreetNameDetailInterface::class)->reveal();
        $request = new StreetNameDetailRequest($streetNameId);
        $response = new StreetNameDetailResponse($streetNameDetail);

        $address = new StreetNameService(
            $this->createClientMock($request, $response)
        );

        $this->assertEquals(
            $streetNameDetail,
            $address->detail($streetNameId)
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
