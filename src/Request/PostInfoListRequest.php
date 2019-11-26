<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Request;

use DigipolisGent\Flanders\BasicRegisters\Filter\FiltersInterface;
use DigipolisGent\Flanders\BasicRegisters\Pager\PagerInterface;
use DigipolisGent\Flanders\BasicRegisters\Uri\PostInfoListUri;

/**
 * Request to get a list of post info.
 */
final class PostInfoListRequest extends AbstractJsonRequest
{
    /**
     * Create a new post info list request.
     *
     * @param \DigipolisGent\Flanders\BasicRegisters\Filter\FiltersInterface|null $filters
     *   Optional filters to limit the list by.
     *   This request supports only 1 filter: MunicipalityNameFilter.
     * @param \DigipolisGent\Flanders\BasicRegisters\Pager\PagerInterface|null $pager
     *   Optional pager to limit the list by.
     */
    public function __construct(?FiltersInterface $filters = null, ?PagerInterface $pager = null)
    {
        $uri = PostInfoListUri::fromFiltersAndPager($filters, $pager);

        parent::__construct($uri);
    }
}
