<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Request;

use DigipolisGent\Flanders\BasicRegisters\Filter\FiltersInterface;
use DigipolisGent\Flanders\BasicRegisters\Pager\PagerInterface;
use DigipolisGent\Flanders\BasicRegisters\Uri\StreetNameListUri;

/**
 * Request to get a list of street names.
 */
final class StreetNameListRequest extends AbstractJsonRequest
{
    /**
     * Create a new street name list request.
     *
     * @param \DigipolisGent\Flanders\BasicRegisters\Filter\FiltersInterface|null $filters
     *   Optional filters to limit the returned street names by.
     * @param \DigipolisGent\Flanders\BasicRegisters\Pager\PagerInterface|null $pager
     *   Optional pager to limit the list by.
     */
    public function __construct(?FiltersInterface $filters = null, ?PagerInterface $pager = null)
    {
        $uri = StreetNameListUri::fromFiltersAndPager($filters, $pager);

        parent::__construct($uri);
    }
}
