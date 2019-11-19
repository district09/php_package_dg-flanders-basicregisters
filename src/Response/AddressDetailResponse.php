<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Response;

use DigipolisGent\API\Client\Response\ResponseInterface;
use DigipolisGent\Flanders\BasicRegisters\Value\Address\AddressDetailInterface;

/**
 * Response containing the address detail value.
 */
final class AddressDetailResponse implements ResponseInterface
{
    /**
     * Address detail value.
     *
     * @var \DigipolisGent\Flanders\BasicRegisters\Value\Address\AddressDetailInterface
     */
    private $addressDetail;

    /**
     * Constructor.
     *
     * @param \DigipolisGent\Flanders\BasicRegisters\Value\Address\AddressDetailInterface $addressDetail
     */
    public function __construct(AddressDetailInterface $addressDetail)
    {
        $this->addressDetail = $addressDetail;
    }

    /**
     * Get the address details.
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\Address\AddressDetailInterface
     */
    public function addressDetail(): AddressDetailInterface
    {
        return $this->addressDetail;
    }
}
