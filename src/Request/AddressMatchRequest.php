<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Request;

use DigipolisGent\API\Client\Request\AbstractJsonRequest;
use DigipolisGent\Flanders\BasicRegisters\Filter\FiltersInterface;
use DigipolisGent\Flanders\BasicRegisters\Uri\AddressMatchUri;

/**
 * Request to get a list of addresses matching partial filter values.
 */
final class AddressMatchRequest extends AbstractJsonRequest
{
    /**
     * Create a new address list request.
     *
     * @param \DigipolisGent\Flanders\BasicRegisters\Filter\FiltersInterface|null $filters
     *   Optional filters to limit the list by.
     */
    public function __construct(?FiltersInterface $filters = null)
    {
        $uri = AddressMatchUri::fromFilters($filters);
        parent::__construct($uri);
    }
}
