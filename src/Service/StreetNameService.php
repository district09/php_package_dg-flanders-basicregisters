<?php

namespace DigipolisGent\Flanders\BasicRegisters\Service;

use DigipolisGent\API\Service\ServiceAbstract;
use DigipolisGent\Flanders\BasicRegisters\Cache\CacheKey;
use DigipolisGent\Flanders\BasicRegisters\Filter\FiltersInterface;
use DigipolisGent\Flanders\BasicRegisters\Pager\PagerInterface;
use DigipolisGent\Flanders\BasicRegisters\Request\StreetNameDetailRequest;
use DigipolisGent\Flanders\BasicRegisters\Request\StreetNameListRequest;
use DigipolisGent\Flanders\BasicRegisters\Value\Street\StreetNameDetailInterface;
use DigipolisGent\Flanders\BasicRegisters\Value\Street\StreetNameId;
use DigipolisGent\Flanders\BasicRegisters\Value\Street\StreetNames;

/**
 * Service to access the Flanders Basic register service street name methods.
 */
final class StreetNameService extends ServiceAbstract implements StreetNameServiceInterface
{
    /**
     * @inheritDoc
     */
    public function list(?FiltersInterface $filters = null, ?PagerInterface $pager = null): StreetNames
    {
        $request = new StreetNameListRequest($filters, $pager);
        return $this->client()->send($request)->streetNames();
    }

    /**
     * @inheritDoc
     */
    public function detail(StreetNameId $streetNameId): StreetNameDetailInterface
    {
        $cacheKey = CacheKey::fromId($streetNameId)->value();

        $detail = $this->cacheGet($cacheKey);
        if (!$detail) {
            $request = new StreetNameDetailRequest($streetNameId);
            $detail = $this->client()->send($request)->streetNameDetail();

            $this->cacheSet($cacheKey, $detail);
        }

        return $detail;
    }
}
