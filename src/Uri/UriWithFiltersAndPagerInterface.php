<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Uri;

use DigipolisGent\API\Client\Uri\UriInterface;
use DigipolisGent\Flanders\BasicRegisters\Filter\FiltersInterface;
use DigipolisGent\Flanders\BasicRegisters\Pager\PagerInterface;

/**
 * Adds filter and pager support the URI object.
 */
interface UriWithFiltersAndPagerInterface extends UriInterface
{
    /**
     * URI with only filters.
     *
     * @param \DigipolisGent\Flanders\BasicRegisters\Filter\FiltersInterface|null $filters
     *   Optional filters to limit the list by.
     *
     * @return \DigipolisGent\API\Client\Uri\UriInterface
     */
    public static function fromFilters(?FiltersInterface $filters = null): UriInterface;

    /**
     * URI with only pager.
     *
     * @param \DigipolisGent\Flanders\BasicRegisters\Pager\PagerInterface|null $pager
     *   Optional pager to limit the list by.
     *
     * @return \DigipolisGent\API\Client\Uri\UriInterface
     */
    public static function fromPager(?PagerInterface $pager = null): UriInterface;

    /**
     * From Filters & Pager.
     *
     * @param \DigipolisGent\Flanders\BasicRegisters\Filter\FiltersInterface|null $filters
     *   Optional filters to limit the list by.
     * @param \DigipolisGent\Flanders\BasicRegisters\Pager\PagerInterface|null $pager
     *   Optional pager to limit the list by.
     *
     * @return \DigipolisGent\API\Client\Uri\UriInterface
     */
    public static function fromFiltersAndPager(
        ?FiltersInterface $filters = null,
        ?PagerInterface $pager = null
    ): UriInterface;
}
