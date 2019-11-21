<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Value\Geographical;

/**
 * Interface for objects containing the GeographicalNames collection.
 */
interface WithGeographicalNamesInterface
{
    /**
     * Get all the geographical names.
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\Geographical\GeographicalNames
     */
    public function geographicalNames(): GeographicalNames;

    /**
     * Get the default name of the object.
     *
     * This will return the GeographicalNames::name() value.
     *
     * @return string
     */
    public function name(): string;
}
