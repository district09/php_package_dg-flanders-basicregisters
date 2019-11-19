<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Response;

use DigipolisGent\API\Client\Response\ResponseInterface;
use DigipolisGent\Flanders\BasicRegisters\Value\Address\Addresses;

/**
 * Response containing the list of address objects.
 */
final class AddressListResponse implements ResponseInterface
{
    /**
     * Addresses.
     *
     * @var \DigipolisGent\Flanders\BasicRegisters\Value\Address\Addresses
     */
    private $addresses;

    /**
     * Constructor.
     *
     * @param \DigipolisGent\Flanders\BasicRegisters\Value\Address\Addresses
     */
    public function __construct(Addresses $addresses)
    {
        $this->addresses = $addresses;
    }

    /**
     * Get the addresses.
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\Address\Addresses
     */
    public function addresses(): Addresses
    {
        return $this->addresses;
    }
}
