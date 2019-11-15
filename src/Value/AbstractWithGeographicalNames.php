<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Value;

use DigipolisGent\Value\ValueAbstract;
use DigipolisGent\Value\ValueInterface;

/**
 * A locality.
 */
abstract class AbstractWithGeographicalNames extends ValueAbstract
{

    /**
     * The geographical names.
     *
     * @var \DigipolisGent\Flanders\BasicRegisters\Value\GeographicalNames
     */
    private $geographicalNames;

    /**
     * Construct a new object from its geographical names.
     *
     * @param \DigipolisGent\Flanders\BasicRegisters\Value\GeographicalNames $geographicalNames
     */
    public function __construct(GeographicalNames $geographicalNames)
    {
        $this->geographicalNames = $geographicalNames;
    }

    /**
     * Get all the geographical names.
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\GeographicalNames
     */
    public function geographicalNames(): GeographicalNames
    {
        return $this->geographicalNames;
    }

    /**
     * Get the default name of the object.
     *
     * This will return the GeographicalNames::name() value.
     *
     * @return string
     */
    public function name(): string
    {
        return $this->geographicalNames()->name();
    }

    /**
     * @inheritDoc
     */
    public function sameValueAs(ValueInterface $object): bool
    {
        /** @var \DigipolisGent\Flanders\BasicRegisters\Value\AbstractWithGeographicalNames $object */
        return $this->sameValueTypeAs($object)
            && $this->geographicalNames()->sameValueAs($object->geographicalNames());
    }

    /**
     * @inheritDoc
     */
    public function __toString(): string
    {
        return $this->name();
    }
}
