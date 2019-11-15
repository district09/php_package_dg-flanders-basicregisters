<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Value;

use DigipolisGent\Flanders\BasicRegisters\Value\Position\PointInterface;
use DigipolisGent\Value\ValueInterface;

/**
 * Interface of an Address object with all its details.
 */
interface AddressDetailInterface extends ValueInterface
{
    /**
     * Get the address id.
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\AddressId
     */
    public function addressId(): AddressId;

    /**
     * Get the locality.
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\Locality
     */
    public function locality(): Locality;

    /**
     * Get the street name.
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\StreetName
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
