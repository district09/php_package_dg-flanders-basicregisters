<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Service;

use DigipolisGent\API\Service\ServiceInterface;
use DigipolisGent\Flanders\BasicRegisters\Pager\PagerInterface;
use DigipolisGent\Flanders\BasicRegisters\Value\Municipality\MunicipalityNameDetailInterface;
use DigipolisGent\Flanders\BasicRegisters\Value\Municipality\MunicipalityNameId;
use DigipolisGent\Flanders\BasicRegisters\Value\Municipality\MunicipalityNames;

/**
 * Service to access the Flanders Basic register service municipality methods.
 */
interface MunicipalityNameServiceInterface extends ServiceInterface
{
    /**
     * Get a (paged) list of municipalities.
     *
     * @param \DigipolisGent\Flanders\BasicRegisters\Pager\PagerInterface|null $pager
     *   Optional pager.
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\Municipality\MunicipalityNames
     *   The municipality names collection.
     */
    public function list(PagerInterface $pager = null): MunicipalityNames;

    /**
     * Get the details of a single municipality name.
     *
     * @param \DigipolisGent\Flanders\BasicRegisters\Value\Municipality\MunicipalityNameId $municipalityNameId
     *   The municipality id to get the details for.
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\Municipality\MunicipalityNameDetailInterface
     *   The municipality detail value.
     */
    public function detail(MunicipalityNameId $municipalityNameId): MunicipalityNameDetailInterface;
}
