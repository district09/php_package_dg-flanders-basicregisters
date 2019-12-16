<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Service;

use DigipolisGent\API\Service\ServiceInterface;
use DigipolisGent\Flanders\BasicRegisters\Filter\FiltersInterface;
use DigipolisGent\Flanders\BasicRegisters\Pager\PagerInterface;
use DigipolisGent\Flanders\BasicRegisters\Value\Post\PostInfoId;
use DigipolisGent\Flanders\BasicRegisters\Value\Post\PostInfoInterface;
use DigipolisGent\Flanders\BasicRegisters\Value\Post\PostInfos;

/**
 * Service to access the Flanders Basic register service post info methods.
 */
interface PostInfoServiceInterface extends ServiceInterface
{
    /**
     * Get a list of post info's, optionally filtered and paged.
     *
     * @param \DigipolisGent\Flanders\BasicRegisters\Filter\FiltersInterface|null $filters
     *   Optional filters to limit the returned street names by.
     *   NOTE: There is only 1 filter that can be used:
     *         - MunicipalityNameFilter : filter the street names by their
     *           municipality name. This will include the submunicipalities.
     * @param \DigipolisGent\Flanders\BasicRegisters\Pager\PagerInterface|null $pager
     *   Optional pager.
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\Post\PostInfos
     *   The post info collection.
     */
    public function list(?FiltersInterface $filters = null, ?PagerInterface $pager = null): PostInfos;

    /**
     * Get the details of a post info.
     *
     * @param \DigipolisGent\Flanders\BasicRegisters\Value\Post\PostInfoId $postInfoId
     *   The street name id to get the details for.
     *
     * @return PostInfoInterface
     *   The post info detail value.
     */
    public function detail(PostInfoId $postInfoId): PostInfoInterface;
}
