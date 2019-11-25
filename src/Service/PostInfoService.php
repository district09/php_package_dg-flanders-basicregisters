<?php

namespace DigipolisGent\Flanders\BasicRegisters\Service;

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
final class PostInfoService extends AbstractService implements PostInfoServiceInterface
{
    /**
     * @inheritDoc
     */
    public function list(?FiltersInterface $filters = null, ?PagerInterface $pager = null): PostInfos
    {
        $request = new PostInfoListRequest($filters, $pager);
        return $this->client()->send($request)->postInfos();
    }

    /**
     * @inheritDoc
     */
    public function detail(PostInfoId $postInfoId): PostInfoInterface
    {
        $request = new PostInfoDetailRequest($postInfoId);
        return $this->client()->send($request)->postInfo();
    }
}
