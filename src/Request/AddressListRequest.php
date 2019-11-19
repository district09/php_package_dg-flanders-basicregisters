<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Request;

use DigipolisGent\API\Client\Request\AbstractRequest;
use DigipolisGent\Flanders\BasicRegisters\Filter\Filters;
use DigipolisGent\Flanders\BasicRegisters\Pager\Pager;
use DigipolisGent\Flanders\BasicRegisters\Uri\AddressesUri;

/**
 * Request to get a list of addresses.
 */
final class AddressListRequest extends AbstractRequest
{
    /**
     * Create a new address list request.
     *
     * @param \DigipolisGent\Flanders\BasicRegisters\Filter\Filters|null $filters
     *   Optional filters to limit the list by.
     * @param \DigipolisGent\Flanders\BasicRegisters\Pager\Pager|null $pager
     *   Optional pager to limit the list by.
     */
    public function __construct(?Filters $filters = null, ?Pager $pager = null)
    {
        $uri = new AddressesUri($filters, $pager);
        parent::__construct($uri);
    }
}
