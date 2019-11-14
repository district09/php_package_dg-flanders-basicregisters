<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Value;

use DigipolisGent\Value\ValueAbstract;
use DigipolisGent\Value\ValueInterface;

/**
 * A locality.
 */
final class Locality extends ValueAbstract
{

    /**
     * The object id.
     *
     * @var \DigipolisGent\Flanders\BasicRegisters\Value\ObjectId
     */
    private $objectId;

    /**
     * The geographical names.
     *
     * @var \DigipolisGent\Flanders\BasicRegisters\Value\GeographicalNames
     */
    private $geographicalNames;

    /**
     * Construct a new object from its object id and geographical names.
     *
     * @param \DigipolisGent\Flanders\BasicRegisters\Value\ObjectId $objectId
     * @param \DigipolisGent\Flanders\BasicRegisters\Value\GeographicalNames $geographicalNames
     */
    public function __construct(ObjectId $objectId, GeographicalNames $geographicalNames)
    {
        $this->objectId = $objectId;
        $this->geographicalNames = $geographicalNames;
    }

    /**
     * Get the object id.
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\ObjectId
     */
    public function objectId(): ObjectId
    {
        return $this->objectId;
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
     * Get the default name of the locality.
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
        /** @var \DigipolisGent\Flanders\BasicRegisters\Value\Locality $object */
        return $this->sameValueTypeAs($object)
            && $this->objectId()->sameValueAs($object->objectId())
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
