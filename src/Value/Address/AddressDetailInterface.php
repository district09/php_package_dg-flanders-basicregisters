<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Value\Address;

use DigipolisGent\Flanders\BasicRegisters\Value\Municipality\Municipality;
use DigipolisGent\Flanders\BasicRegisters\Value\Position\PointInterface;
use DigipolisGent\Flanders\BasicRegisters\Value\Street\StreetName;
use DigipolisGent\Value\ValueInterface;

/**
 * Interface of an Address object with all its details.
 */
interface AddressDetailInterface extends ValueInterface
{
    /**
     * Get the address id.
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\Address\AddressId
     */
    public function addressId(): AddressId;

    /**
     * Get the municipality.
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\Municipality\Municipality
     */
    public function municipality(): Municipality;

    /**
     * Get the street name.
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\Street\StreetName
     */
    public function streetName(): StreetName;

    /**
     * Get the house number.
     *
     * @return string
     */
    public function houseNumber(): string;

    /**
     * Get the bus number.
     *
     * @return string
     */
    public function busNumber(): string;

    /**
     * Get the position.
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\Position\PointInterface|ValueInterface
     */
    public function position(): PointInterface;
}
