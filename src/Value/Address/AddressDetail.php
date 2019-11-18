<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Value\Address;

use DigipolisGent\Flanders\BasicRegisters\Value\Locality\Locality;
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
     * The locality.
     *
     * @var \DigipolisGent\Flanders\BasicRegisters\Value\Locality\Locality
     */
    private $locality;

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
     * @param \DigipolisGent\Flanders\BasicRegisters\Value\Locality\Locality $locality
     * @param \DigipolisGent\Flanders\BasicRegisters\Value\Street\StreetName $streetName
     * @param \DigipolisGent\Flanders\BasicRegisters\Value\Position\PointInterface $position
     */
    public function __construct(
        Address $address,
        Locality $locality,
        StreetName $streetName,
        PointInterface $position
    ) {
        $this->address = $address;
        $this->locality = $locality;
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
    public function locality(): Locality
    {
        return $this->locality;
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
            && $this->locality()->sameValueAs($object->locality())
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
