<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Value\Geographical;

use DigipolisGent\Value\ValueAbstract;
use DigipolisGent\Value\ValueInterface;

/**
 * Shared functionality for values containing a GeographicalName value.
 */
abstract class AbstractWithGeographicalName extends ValueAbstract implements WithGeographicalNameInterface
{
    /**
     * The geographical name.
     *
     * @var \DigipolisGent\Flanders\BasicRegisters\Value\Geographical\GeographicalName
     */
    private $geographicalName;

    /**
     * Construct a new object from its geographical name.
     *
     * @param \DigipolisGent\Flanders\BasicRegisters\Value\Geographical\GeographicalName $geographicalName
     */
    public function __construct(GeographicalName $geographicalName)
    {
        $this->geographicalName = $geographicalName;
    }

    /**
     * Get all the geographical name.
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\Geographical\GeographicalName
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
        /** @var \DigipolisGent\Flanders\BasicRegisters\Value\Geographical\AbstractWithGeographicalName $object */
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
