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
use DigipolisGent\Tests\Flanders\BasicRegisters\TestCase;
use Psr\Http\Message\RequestInterface;
use Psr\SimpleCache\CacheInterface;

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

        $streetNameService = new StreetNameService(
            $this->createClientMock($request, $response)
        );

        $this->assertEquals(
            $streetNameDetail,
            $streetNameService->detail($streetNameId)
        );
    }

    /**
     * The address details are cached.
     *
     * @test
     */
    public function detailIsStoredIntoCache(): void
    {
        $streetNameId = new StreetNameId(9731);
        $streetNameDetail = $this->prophesize(StreetNameDetailInterface::class)->reveal();

        $request = new StreetNameDetailRequest($streetNameId);
        $response = new StreetNameDetailResponse($streetNameDetail);
        $client = $this->createClientMock($request, $response);

        $cache = $this->prophesize(CacheInterface::class);
        $cache
            ->get('FlandersBasicRegister:StreetNameId:9731', null)
            ->willReturn(null)
            ->shouldBeCalled();
        $cache
            ->set('FlandersBasicRegister:StreetNameId:9731', $streetNameDetail, null)
            ->willReturn(true)
            ->shouldBeCalled();

        $streetNameService = new StreetNameService($client);
        $streetNameService->setCacheService($cache->reveal());

        $this->assertEquals(
            $streetNameDetail,
            $streetNameService->detail($streetNameId)
        );
    }

    /**
     * Details are retrieved from cache when available.
     *
     * @test
     */
    public function detailIsLoadedFromCacheWhenAvailable(): void
    {
        $streetNameId = new StreetNameId(9731);
        $streetNameDetail = $this->prophesize(StreetNameDetailInterface::class)->reveal();

        $client = $this->prophesize(ClientInterface::class);
        $client->send()->shouldNotBeCalled();

        $cache = $this->prophesize(CacheInterface::class);
        $cache
            ->get('FlandersBasicRegister:StreetNameId:9731', null)
            ->willReturn($streetNameDetail)
            ->shouldBeCalled();
        $cache->set()->shouldNotBeCalled();

        $streetNameService = new StreetNameService($client->reveal());
        $streetNameService->setCacheService($cache->reveal());

        $this->assertEquals(
            $streetNameDetail,
            $streetNameService->detail($streetNameId)
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
