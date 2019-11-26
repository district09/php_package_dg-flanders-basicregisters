<?php

namespace DigipolisGent\Flanders\BasicRegisters\Service;

use DigipolisGent\Flanders\BasicRegisters\Pager\PagerInterface;
use DigipolisGent\Flanders\BasicRegisters\Request\MunicipalityNameDetailRequest;
use DigipolisGent\Flanders\BasicRegisters\Request\MunicipalityNameListRequest;
use DigipolisGent\Flanders\BasicRegisters\Value\Municipality\MunicipalityNameDetailInterface;
use DigipolisGent\Flanders\BasicRegisters\Value\Municipality\MunicipalityNameId;
use DigipolisGent\Flanders\BasicRegisters\Value\Municipality\MunicipalityNames;

/**
 * Service to access the Flanders Basic register service municipality methods.
 */
final class MunicipalityNameService extends AbstractService implements MunicipalityNameServiceInterface
{
    /**
     * @inheritDoc
     */
    public function list(PagerInterface $pager = null): MunicipalityNames
    {
        $request = new MunicipalityNameListRequest($pager);
        return $this->client()->send($request)->municipalityNames();
    }

    /**
     * @inheritDoc
     */
    public function detail(MunicipalityNameId $municipalityNameId): MunicipalityNameDetailInterface
    {
        $request = new MunicipalityNameDetailRequest($municipalityNameId);
        return $this->client()->send($request)->municipalityNameDetail();
    }
}
