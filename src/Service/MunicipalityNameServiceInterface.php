<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Service;

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
     * Look up addresses that match (partial) filter values.
     *
     * @param \DigipolisGent\Flanders\BasicRegisters\Pager\PagerInterface|null $pager
     *   Optional pager.
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\Municipality\MunicipalityNames
     *   The matching addresses.
     */
    public function list(PagerInterface $pager = null): MunicipalityNames;

    /**
     * Get the details of a single municipality name.
     *
     * @param \DigipolisGent\Flanders\BasicRegisters\Value\Municipality\MunicipalityNameId $municipalityNameId
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\Municipality\MunicipalityNameDetailInterface
     */
    public function detail(MunicipalityNameId $municipalityNameId): MunicipalityNameDetailInterface;
}
