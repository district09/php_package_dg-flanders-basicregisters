<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Value;

use DigipolisGent\Flanders\BasicRegisters\Value\Position\PointInterface;
use DigipolisGent\Value\ValueAbstract;
use DigipolisGent\Value\ValueInterface;

/**
 * Address object with all its details.
 */
class AddressDetail extends ValueAbstract
{
    /**
     * The address object.
     *
     * @var \DigipolisGent\Flanders\BasicRegisters\Value\Address
     */
    private $address;

    /**
     * The locality.
     *
     * @var \DigipolisGent\Flanders\BasicRegisters\Value\Locality
     */
    private $locality;

    /**
     * The post info object id.
     *
     * @var \DigipolisGent\Flanders\BasicRegisters\Value\ObjectId
     */
    private $postInfoId;

    /**
     * The street name.
     *
     * @var \DigipolisGent\Flanders\BasicRegisters\Value\StreetName
     */
    private $streetName;

    /**
     * The address position.
     *
     * @var \DigipolisGent\Flanders\BasicRegisters\Value\Position\PointInterface
     */
    private $position;

    /**
     * Create object from its details.
     *
     * @param \DigipolisGent\Flanders\BasicRegisters\Value\Address $address
     * @param \DigipolisGent\Flanders\BasicRegisters\Value\Locality $locality
     * @param \DigipolisGent\Flanders\BasicRegisters\Value\ObjectId $postInfoId
     * @param \DigipolisGent\Flanders\BasicRegisters\Value\StreetName $streetName
     * @param \DigipolisGent\Flanders\BasicRegisters\Value\Position\PointInterface $position
     */
    public function __construct(
        Address $address,
        Locality $locality,
        ObjectId $postInfoId,
        StreetName $streetName,
        PointInterface $position
    ) {
        $this->address = $address;
        $this->locality = $locality;
        $this->postInfoId = $postInfoId;
        $this->streetName = $streetName;
        $this->position = $position;
    }

    /**
     * Get the address object id.
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\ObjectId
     */
    public function objectId(): ObjectId
    {
        return $this->address->objectId();
    }

    /**
     * Get the locality.
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\Locality
     */
    public function locality(): Locality
    {
        return $this->locality;
    }

    /**
     * Get the postal code.
     *
     * @return int
     */
    public function postalCode(): int
    {
        return $this->postInfoId->value();
    }

    /**
     * Get the street name.
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\StreetName
     */
    public function streetName(): StreetName
    {
        return $this->streetName;
    }

    /**
     * Get the house number.
     *
     * @return string
     */
    public function houseNumber(): string
    {
        return $this->address->houseNumber();
    }

    /**
     * Get the bus number.
     *
     * @return string
     */
    public function busNumber(): string
    {
        return $this->address->busNumber();
    }

    /**
     * Get the position.
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\Position\PointInterface|ValueInterface
     */
    public function position(): PointInterface
    {
        return $this->position;
    }

    /**
     * @inheritDoc
     */
    public function sameValueAs(ValueInterface $object): bool
    {
        /** @var \DigipolisGent\Flanders\BasicRegisters\Value\AddressDetail $object */
        return $this->sameValueTypeAs($object)
            && $this->objectId()->sameValueAs($object->objectId())
            && $this->locality()->sameValueAs($object->locality())
            && $this->postalCode() === $object->postalCode()
            && $this->streetName()->sameValueAs($object->streetName())
            && $this->position()->sameValueAs($object->position());
    }

    /**
     * @inheritDoc
     */
    public function __toString(): string
    {
        return (string) $this->address;
    }
}
