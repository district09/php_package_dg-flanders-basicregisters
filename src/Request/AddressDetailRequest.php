<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Request;

use DigipolisGent\Flanders\BasicRegisters\Uri\AddressDetailUri;
use DigipolisGent\Flanders\BasicRegisters\Value\Address\AddressId;

/**
 * Request to get the details of a single address.
 */
final class AddressDetailRequest extends AbstractJsonRequest
{
    /**
     * Create a new address detail request.
     *
     * @param \DigipolisGent\Flanders\BasicRegisters\Value\Address\AddressId $addressId
     */
    public function __construct(AddressId $addressId)
    {
        parent::__construct(
            new AddressDetailUri($addressId)
        );
    }
}
