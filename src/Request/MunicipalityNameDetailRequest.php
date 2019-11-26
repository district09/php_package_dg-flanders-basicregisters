<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Request;

use DigipolisGent\Flanders\BasicRegisters\Uri\MunicipalityNameDetailUri;
use DigipolisGent\Flanders\BasicRegisters\Value\Municipality\MunicipalityNameId;

/**
 * Request to get the details of a single municipality name.
 */
final class MunicipalityNameDetailRequest extends AbstractJsonRequest
{
    /**
     * Create a new municipality name detail request.
     *
     * @param \DigipolisGent\Flanders\BasicRegisters\Value\Municipality\MunicipalityNameId $municipalityNameId
     */
    public function __construct(MunicipalityNameId $municipalityNameId)
    {
        parent::__construct(
            new MunicipalityNameDetailUri($municipalityNameId)
        );
    }
}
