<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Value\Street;

use DigipolisGent\Flanders\BasicRegisters\Value\Geographical\WithGeographicalNamesInterface;
use DigipolisGent\Flanders\BasicRegisters\Value\Municipality\MunicipalityName;
use DigipolisGent\Value\ValueInterface;

/**
 * A Street name.
 */
interface StreetNameDetailInterface extends ValueInterface, WithGeographicalNamesInterface
{
    /**
     * Get the street name id.
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\Street\StreetNameId
     */
    public function streetNameId(): StreetNameId;

    /**
     * Return the municipality name.
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\Municipality\MunicipalityName
     */
    public function municipalityName(): MunicipalityName;
}
