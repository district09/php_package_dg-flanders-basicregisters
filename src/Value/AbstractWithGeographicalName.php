<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Value;

use DigipolisGent\Value\ValueAbstract;
use DigipolisGent\Value\ValueInterface;

/**
 * A locality.
 */
abstract class AbstractWithGeographicalName extends ValueAbstract
{

    /**
     * The geographical name.
     *
     * @var \DigipolisGent\Flanders\BasicRegisters\Value\GeographicalName
     */
    private $geographicalName;

    /**
     * Construct a new object from its geographical name.
     *
     * @param \DigipolisGent\Flanders\BasicRegisters\Value\GeographicalName $geographicalName
     */
    public function __construct(GeographicalName $geographicalName)
    {
        $this->geographicalName = $geographicalName;
    }

    /**
     * Get all the geographical name.
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\GeographicalName
     */
    public function geographicalName(): GeographicalName
    {
        return $this->geographicalName;
    }

    /**
     * Get the name of the object.
     *
     * This will return the GeographicalName::spelling() value.
     *
     * @return string
     */
    public function name(): string
    {
        return $this->geographicalName()->spelling();
    }

    /**
     * @inheritDoc
     */
    public function sameValueAs(ValueInterface $object): bool
    {
        /** @var \DigipolisGent\Flanders\BasicRegisters\Value\AbstractWithGeographicalName $object */
        return $this->sameValueTypeAs($object)
            && $this->geographicalName()->sameValueAs($object->geographicalName());
    }

    /**
     * @inheritDoc
     */
    public function __toString(): string
    {
        return $this->name();
    }
}
