<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Service;

use DigipolisGent\API\Client\ClientInterface;
use DigipolisGent\API\Client\Response\ResponseInterface;
use DigipolisGent\Flanders\BasicRegisters\Request\PostInfoDetailRequest;
use DigipolisGent\Flanders\BasicRegisters\Request\PostInfoListRequest;
use DigipolisGent\Flanders\BasicRegisters\Response\PostInfoDetailResponse;
use DigipolisGent\Flanders\BasicRegisters\Response\PostInfoListResponse;
use DigipolisGent\Flanders\BasicRegisters\Filter\FiltersInterface;
use DigipolisGent\Flanders\BasicRegisters\Pager\PagerInterface;
use DigipolisGent\Flanders\BasicRegisters\Service\PostInfoService;
use DigipolisGent\Flanders\BasicRegisters\Value\Post\PostInfoId;
use DigipolisGent\Flanders\BasicRegisters\Value\Post\PostInfoInterface;
use DigipolisGent\Flanders\BasicRegisters\Value\Post\PostInfos;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestInterface;
use Psr\SimpleCache\CacheInterface;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Service\PostInfoService
 */
class PostInfoServiceTest extends TestCase
{
    /**
     * Get the post info list.
     *
     * @test
     */
    public function listReturnsPostInfoCollection(): void
    {
        $filters = $this->createFiltersMock();
        $pager = $this->createPagerMock();

        $postInfos = new PostInfos();
        $request = new PostInfoListRequest($filters, $pager);
        $response = new PostInfoListResponse($postInfos);

        $postInfoService = new PostInfoService(
            $this->createClientMock($request, $response)
        );

        $this->assertEquals(
            $postInfos,
            $postInfoService->list($filters, $pager)
        );
    }

    /**
     * Get the post info details for a given PostInfoId.
     *
     * @test
     */
    public function detailReturnsPostInfoDetailValue(): void
    {
        $postInfoId = new PostInfoId(973156);
        $postInfo = $this->prophesize(PostInfoInterface::class)->reveal();
        $request = new PostInfoDetailRequest($postInfoId);
        $response = new PostInfoDetailResponse($postInfo);

        $postInfoService = new PostInfoService(
            $this->createClientMock($request, $response)
        );

        $this->assertEquals(
            $postInfo,
            $postInfoService->detail($postInfoId)
        );
    }

    /**
     * The address details are cached.
     *
     * @test
     */
    public function detailIsStoredIntoCache(): void
    {
        $postInfoId = new PostInfoId(973156);
        $postInfo = $this->prophesize(PostInfoInterface::class)->reveal();

        $request = new PostInfoDetailRequest($postInfoId);
        $response = new PostInfoDetailResponse($postInfo);
        $client = $this->createClientMock($request, $response);

        $cache = $this->prophesize(CacheInterface::class);
        $cache
            ->get('FlandersBasicRegister:PostInfoId:973156', null)
            ->willReturn(null)
            ->shouldBeCalled();
        $cache
            ->set('FlandersBasicRegister:PostInfoId:973156', $postInfo, null)
            ->willReturn(true)
            ->shouldBeCalled();

        $postInfoService = new PostInfoService($client);
        $postInfoService->setCacheService($cache->reveal());

        $this->assertEquals(
            $postInfo,
            $postInfoService->detail($postInfoId)
        );
    }

    /**
     * Details are retrieved from cache when available.
     *
     * @test
     */
    public function detailIsLoadedFromCacheWhenAvailable(): void
    {
        $postInfoId = new PostInfoId(973156);
        $postInfo = $this->prophesize(PostInfoInterface::class)->reveal();

        $client = $this->prophesize(ClientInterface::class);
        $client->send()->shouldNotBeCalled();

        $cache = $this->prophesize(CacheInterface::class);
        $cache
            ->get('FlandersBasicRegister:PostInfoId:973156', null)
            ->willReturn($postInfo)
            ->shouldBeCalled();
        $cache->set()->shouldNotBeCalled();

        $postInfoService = new PostInfoService($client->reveal());
        $postInfoService->setCacheService($cache->reveal());

        $this->assertEquals(
            $postInfo,
            $postInfoService->detail($postInfoId)
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
