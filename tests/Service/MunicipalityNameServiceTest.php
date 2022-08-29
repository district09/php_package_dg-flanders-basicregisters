<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Service;

use DigipolisGent\API\Client\ClientInterface;
use DigipolisGent\API\Client\Response\ResponseInterface;
use DigipolisGent\Flanders\BasicRegisters\Service\MunicipalityNameService;
use DigipolisGent\Flanders\BasicRegisters\Pager\PagerInterface;
use DigipolisGent\Flanders\BasicRegisters\Request\MunicipalityNameDetailRequest;
use DigipolisGent\Flanders\BasicRegisters\Request\MunicipalityNameListRequest;
use DigipolisGent\Flanders\BasicRegisters\Response\MunicipalityNameDetailResponse;
use DigipolisGent\Flanders\BasicRegisters\Response\MunicipalityNameListResponse;
use DigipolisGent\Flanders\BasicRegisters\Value\Municipality\MunicipalityNameDetailInterface;
use DigipolisGent\Flanders\BasicRegisters\Value\Municipality\MunicipalityNameId;
use DigipolisGent\Flanders\BasicRegisters\Value\Municipality\MunicipalityNames;
use DigipolisGent\Tests\Flanders\BasicRegisters\TestCase;
use Psr\Http\Message\RequestInterface;
use Psr\SimpleCache\CacheInterface;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Service\MunicipalityNameService
 */
class MunicipalityNameServiceTest extends TestCase
{
    /**
     * Get the list of municipality names.
     *
     * @test
     */
    public function listReturnsMunicipalityNamesCollection(): void
    {
        $pager = $this->createPagerMock();

        $municipalityNames = new MunicipalityNames();
        $request = new MunicipalityNameListRequest($pager);
        $response = new MunicipalityNameListResponse($municipalityNames);

        $basicRegisters = new MunicipalityNameService(
            $this->createClientMock($request, $response)
        );

        $this->assertEquals($municipalityNames, $basicRegisters->list($pager));
    }

    /**
     * Get the municipality name details for a given municipality name ID.
     *
     * @test
     */
    public function detailReturnsMunicipalityNameDetailValue(): void
    {
        $municipalityNameId = new MunicipalityNameId(9731);
        $municipalityNameDetail = $this->prophesize(MunicipalityNameDetailInterface::class)->reveal();

        $request = new MunicipalityNameDetailRequest($municipalityNameId);
        $response = new MunicipalityNameDetailResponse($municipalityNameDetail);

        $basicRegisters = new MunicipalityNameService(
            $this->createClientMock($request, $response)
        );

        $this->assertEquals(
            $municipalityNameDetail,
            $basicRegisters->detail($municipalityNameId)
        );
    }

    /**
     * Detail gets stored into the cache.
     *
     * @test
     */
    public function detailIsStoredIntoCache(): void
    {
        $municipalityNameId = new MunicipalityNameId(9731);
        $municipalityNameDetail = $this->prophesize(MunicipalityNameDetailInterface::class)->reveal();

        $request = new MunicipalityNameDetailRequest($municipalityNameId);
        $response = new MunicipalityNameDetailResponse($municipalityNameDetail);
        $client = $this->createClientMock($request, $response);

        $cache = $this->prophesize(CacheInterface::class);
        $cache
            ->get('FlandersBasicRegister:MunicipalityNameId:9731', null)
            ->willReturn(null)
            ->shouldBeCalled();
        $cache
            ->set('FlandersBasicRegister:MunicipalityNameId:9731', $municipalityNameDetail, null)
            ->willReturn(true)
            ->shouldBeCalled();

        $basicRegisters = new MunicipalityNameService($client);
        $basicRegisters->setCacheService($cache->reveal());

        $this->assertEquals(
            $municipalityNameDetail,
            $basicRegisters->detail($municipalityNameId)
        );
    }

    /**
     * Details are retrieved from cache when available.
     *
     * @test
     */
    public function detailIsLoadedFromCacheWhenAvailable(): void
    {
        $municipalityNameId = new MunicipalityNameId(9731);
        $municipalityNameDetail = $this->prophesize(MunicipalityNameDetailInterface::class)->reveal();

        $client = $this->prophesize(ClientInterface::class);
        $client->send()->shouldNotBeCalled();

        $cache = $this->prophesize(CacheInterface::class);
        $cache
            ->get('FlandersBasicRegister:MunicipalityNameId:9731', null)
            ->willReturn($municipalityNameDetail)
            ->shouldBeCalled();
        $cache->set()->shouldNotBeCalled();

        $basicRegisters = new MunicipalityNameService($client->reveal());
        $basicRegisters->setCacheService($cache->reveal());

        $this->assertEquals(
            $municipalityNameDetail,
            $basicRegisters->detail($municipalityNameId)
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
