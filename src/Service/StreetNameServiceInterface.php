<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Service;

use DigipolisGent\Flanders\BasicRegisters\Filter\FiltersInterface;
use DigipolisGent\Flanders\BasicRegisters\Pager\PagerInterface;
use DigipolisGent\Flanders\BasicRegisters\Value\Street\StreetNameDetailInterface;
use DigipolisGent\Flanders\BasicRegisters\Value\Street\StreetNameId;
use DigipolisGent\Flanders\BasicRegisters\Value\Street\StreetNames;

/**
 * Service to access the Flanders Basic register service street name methods.
 */
interface StreetNameServiceInterface extends ServiceInterface
{
    /**
     * Get a list of street names optionally filtered and paged.
     *
     * @param \DigipolisGent\Flanders\BasicRegisters\Filter\FiltersInterface|null $filters
     *   Optional filters to limit the returned street names by.
     *   NOTE: There is only 1 filter that can be used:
     *         - MunicipalityNameFilter : filter the street names by their
     *           municipality name.
     * @param \DigipolisGent\Flanders\BasicRegisters\Pager\PagerInterface|null $pager
     *   Optional pager.
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\Street\StreetNames
     *   The street names.
     */
    public function list(?FiltersInterface $filters = null, ?PagerInterface $pager = null): StreetNames;

    /**
     * Get the details of a single street name.
     *
     * @param \DigipolisGent\Flanders\BasicRegisters\Value\Street\StreetNameId $streetNameId
     *   The street name id to get the details for.
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\Street\StreetNameDetailInterface
     *   The street name detail value.
     */
    public function detail(StreetNameId $streetNameId): StreetNameDetailInterface;
}
