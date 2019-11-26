<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Value\Municipality;

use DigipolisGent\Flanders\BasicRegisters\Value\Geographical\WithGeographicalNamesInterface;
use DigipolisGent\Value\ValueInterface;

/**
 * A municipality detail value.
 */
interface MunicipalityNameDetailInterface extends ValueInterface, WithGeographicalNamesInterface
{
    /**
     * Get the municipality name id.
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\Municipality\MunicipalityNameId
     */
    public function municipalityNameId(): MunicipalityNameId;
}
