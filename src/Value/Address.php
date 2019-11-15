<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Value;

use DigipolisGent\Value\ValueAbstract;
use DigipolisGent\Value\ValueInterface;

/**
 * A single address as used in the Addresses collection.
 *
 * This contains only a summary of the address, the full address needs to be
 * retrieved as AddressDetail.
 */
class Address extends ValueAbstract
{
    /**
     * The address object id.
     *
     * @var \DigipolisGent\Flanders\BasicRegisters\Value\ObjectId
     */
    private $objectId;

    /**
     * The address house number.
     *
     * @var string
     */
    private $houseNumber;

    /**
     * The address bus number.
     *
     * @var string
     */
    private $busNumber;

    /**
     * The address full address.
     *
     * @var \DigipolisGent\Flanders\BasicRegisters\Value\FullAddress
     */
    private $fullAddress;

    /**
     * Create a new Address value.
     *
     * @param \DigipolisGent\Flanders\BasicRegisters\Value\ObjectId $objectId
     * @param string $houseNumber
     * @param string $busNumber
     * @param \DigipolisGent\Flanders\BasicRegisters\Value\FullAddress $fullAddress
     */
    public function __construct(ObjectId $objectId, string $houseNumber, string $busNumber, FullAddress $fullAddress)
    {
        $this->objectId = $objectId;
        $this->houseNumber = $houseNumber;
        $this->busNumber = $busNumber;
        $this->fullAddress = $fullAddress;
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
     * Get the house number.
     *
     * @return string
     */
    public function houseNumber(): string
    {
        return $this->houseNumber;
    }

    /**
     * Get the bus number.
     *
     * @return string
     */
    public function busNumber(): string
    {
        return $this->busNumber;
    }

    /**
     * Get the full address.
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\FullAddress
     */
    public function fullAddress(): FullAddress
    {
        return $this->fullAddress;
    }

    /**
     * @inheritDoc
     */
    public function sameValueAs(ValueInterface $object): bool
    {
        /** @var \DigipolisGent\Flanders\BasicRegisters\Value\Address $object */
        return $this->sameValueTypeAs($object)
            && $this->objectId()->sameValueAs($object->objectId())
            && $this->houseNumber() === $object->houseNumber()
            && $this->busNumber() === $object->busNumber()
            && $this->fullAddress()->sameValueAs($object->fullAddress());
    }

    /**
     * @inheritDoc
     */
    public function __toString(): string
    {
        return $this->fullAddress()->name();
    }
}
