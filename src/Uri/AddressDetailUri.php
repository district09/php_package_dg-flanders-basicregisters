<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Uri;

use DigipolisGent\API\Client\Uri\UriInterface;
use DigipolisGent\Flanders\BasicRegisters\Value\Address\AddressId;

/**
 * URI to get the details of an address.
 */
class AddressDetailUri implements UriInterface
{
    /**
     * The AddressId.
     *
     * @var \DigipolisGent\Flanders\BasicRegisters\Value\Address\AddressId
     */
    private $addressId;

    /**
     * Create a new URI by passing the AddressId value.
     *
     * @param \DigipolisGent\Flanders\BasicRegisters\Value\Address\AddressId $addressId
     */
    public function __construct(AddressId $addressId)
    {
        $this->addressId = $addressId;
    }

    /**
     * @inheritDoc
     */
    public function getUri()
    {
        return sprintf('adressen/%d', $this->addressId->value());
    }
}
