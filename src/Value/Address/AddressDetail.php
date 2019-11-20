<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Value\Address;

use DigipolisGent\Flanders\BasicRegisters\Value\Municipality\Municipality;
use DigipolisGent\Flanders\BasicRegisters\Value\Position\PointInterface;
use DigipolisGent\Flanders\BasicRegisters\Value\Street\StreetName;
use DigipolisGent\Value\ValueAbstract;
use DigipolisGent\Value\ValueInterface;

/**
 * Address object with all its details.
 */
final class AddressDetail extends ValueAbstract implements AddressDetailInterface
{
    /**
     * The address object.
     *
     * @var \DigipolisGent\Flanders\BasicRegisters\Value\Address\Address
     */
    private $address;

    /**
     * The municipality.
     *
     * @var \DigipolisGent\Flanders\BasicRegisters\Value\Municipality\Municipality
     */
    private $municipality;

    /**
     * The street name.
     *
     * @var \DigipolisGent\Flanders\BasicRegisters\Value\Street\StreetName
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
     * @param \DigipolisGent\Flanders\BasicRegisters\Value\Address\Address $address
     * @param \DigipolisGent\Flanders\BasicRegisters\Value\Municipality\Municipality $municipality
     * @param \DigipolisGent\Flanders\BasicRegisters\Value\Street\StreetName $streetName
     * @param \DigipolisGent\Flanders\BasicRegisters\Value\Position\PointInterface $position
     */
    public function __construct(
        Address $address,
        Municipality $municipality,
        StreetName $streetName,
        PointInterface $position
    ) {
        $this->address = $address;
        $this->municipality = $municipality;
        $this->streetName = $streetName;
        $this->position = $position;
    }

    /**
     * @inheritDoc
     */
    public function addressId(): AddressId
    {
        return $this->address->addressId();
    }

    /**
     * @inheritDoc
     */
    public function municipality(): Municipality
    {
        return $this->municipality;
    }

    /**
     * @inheritDoc
     */
    public function streetName(): StreetName
    {
        return $this->streetName;
    }

    /**
     * @inheritDoc
     */
    public function houseNumber(): string
    {
        return $this->address->houseNumber();
    }

    /**
     * @inheritDoc
     */
    public function busNumber(): string
    {
        return $this->address->busNumber();
    }

    /**
     * @inheritDoc
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
        /** @var \DigipolisGent\Flanders\BasicRegisters\Value\Address\AddressDetail $object */
        return $this->sameValueTypeAs($object)
            && $this->addressId()->sameValueAs($object->addressId())
            && $this->municipality()->sameValueAs($object->municipality())
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
