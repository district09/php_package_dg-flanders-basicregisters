<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Response;

use DigipolisGent\API\Client\Response\ResponseInterface;
use DigipolisGent\Flanders\BasicRegisters\Value\Address\AddressMatches;

/**
 * Response containing the list of address match objects.
 */
final class AddressMatchResponse implements ResponseInterface
{
    /**
     * Addresses.
     *
     * @var \DigipolisGent\Flanders\BasicRegisters\Value\Address\AddressMatches
     */
    private $addressMatches;

    /**
     * Constructor.
     *
     * @param \DigipolisGent\Flanders\BasicRegisters\Value\Address\AddressMatches
     */
    public function __construct(AddressMatches $addressMatches)
    {
        $this->addressMatches = $addressMatches;
    }

    /**
     * Get the addresses.
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\Address\AddressMatches
     */
    public function addressMatches(): AddressMatches
    {
        return $this->addressMatches;
    }
}
