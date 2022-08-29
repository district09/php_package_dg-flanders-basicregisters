<?php

namespace DigipolisGent\Flanders\BasicRegisters\Service;

use DigipolisGent\API\Service\ServiceAbstract;
use DigipolisGent\Flanders\BasicRegisters\Cache\CacheKey;
use DigipolisGent\Flanders\BasicRegisters\Filter\FiltersInterface;
use DigipolisGent\Flanders\BasicRegisters\Pager\PagerInterface;
use DigipolisGent\Flanders\BasicRegisters\Request\PostInfoDetailRequest;
use DigipolisGent\Flanders\BasicRegisters\Request\PostInfoListRequest;
use DigipolisGent\Flanders\BasicRegisters\Value\Post\PostInfoId;
use DigipolisGent\Flanders\BasicRegisters\Value\Post\PostInfoInterface;
use DigipolisGent\Flanders\BasicRegisters\Value\Post\PostInfos;

/**
 * Service to access the Flanders Basic register post info methods.
 */
final class PostInfoService extends ServiceAbstract implements PostInfoServiceInterface
{
    /**
     * @inheritDoc
     */
    public function list(?FiltersInterface $filters = null, ?PagerInterface $pager = null): PostInfos
    {
        $request = new PostInfoListRequest($filters, $pager);

        /** @var \DigipolisGent\Flanders\BasicRegisters\Response\PostInfoListResponse $response */
        $response = $this->client()->send($request);
        return $response->postInfos();
    }

    /**
     * @inheritDoc
     */
    public function detail(PostInfoId $postInfoId): PostInfoInterface
    {
        $cacheKey = CacheKey::fromId($postInfoId)->value();

        $detail = $this->cacheGet($cacheKey);
        if (!$detail) {
            $request = new PostInfoDetailRequest($postInfoId);

            /** @var \DigipolisGent\Flanders\BasicRegisters\Response\PostInfoDetailResponse $response */
            $response = $this->client()->send($request);
            $detail = $response->postInfo();

            $this->cacheSet($cacheKey, $detail);
        }

        return $detail;
    }
}
