<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Value\Geographical;

/**
 * Interface for values containing the GeographicalName value.
 */
interface WithGeographicalNameInterface
{
    /**
     * Get all the geographical name.
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\Geographical\GeographicalName
     */
    public function geographicalName(): GeographicalName;

    /**
     * Get the name of the object.
     *
     * This will return the GeographicalName::spelling() value.
     *
     * @return string
     */
    public function name(): string;
}
