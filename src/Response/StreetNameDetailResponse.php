<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Response;

use DigipolisGent\API\Client\Response\ResponseInterface;
use DigipolisGent\Flanders\BasicRegisters\Value\Street\StreetNameDetailInterface;

/**
 * Response containing the street name detail value.
 */
final class StreetNameDetailResponse implements ResponseInterface
{
    /**
     * Street name detail value.
     *
     * @var \DigipolisGent\Flanders\BasicRegisters\Value\Street\StreetNameDetailInterface
     */
    private $streetNameDetail;

    /**
     * Constructor.
     *
     * @param \DigipolisGent\Flanders\BasicRegisters\Value\Street\StreetNameDetailInterface $streetNameDetail
     */
    public function __construct(StreetNameDetailInterface $streetNameDetail)
    {
        $this->streetNameDetail = $streetNameDetail;
    }

    /**
     * Get the address details.
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\Street\StreetNameDetailInterface
     */
    public function streetNameDetail(): StreetNameDetailInterface
    {
        return $this->streetNameDetail;
    }
}
