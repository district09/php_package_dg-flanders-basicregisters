<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Request;

use DigipolisGent\API\Client\Request\AbstractRequest;
use DigipolisGent\Flanders\BasicRegisters\Filter\FiltersInterface;
use DigipolisGent\Flanders\BasicRegisters\Pager\PagerInterface;
use DigipolisGent\Flanders\BasicRegisters\Uri\AddressListUri;

/**
 * Request to get a list of addresses.
 */
final class AddressListRequest extends AbstractRequest
{
    /**
     * Create a new address list request.
     *
     * @param \DigipolisGent\Flanders\BasicRegisters\Filter\FiltersInterface|null $filters
     *   Optional filters to limit the list by.
     * @param \DigipolisGent\Flanders\BasicRegisters\Pager\PagerInterface|null $pager
     *   Optional pager to limit the list by.
     */
    public function __construct(?FiltersInterface $filters = null, ?PagerInterface $pager = null)
    {
        $uri = AddressListUri::fromFiltersAndPager($filters, $pager);

        parent::__construct($uri);
    }
}
