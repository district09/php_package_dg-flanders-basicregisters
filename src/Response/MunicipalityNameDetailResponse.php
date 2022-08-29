<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Response;

use DigipolisGent\API\Client\Response\ResponseInterface;
use DigipolisGent\Flanders\BasicRegisters\Value\Municipality\MunicipalityNameDetailInterface;

/**
 * Response containing the municipality name detail value.
 */
final class MunicipalityNameDetailResponse implements ResponseInterface
{
    /**
     * Municipality name detail value.
     *
     * @var \DigipolisGent\Flanders\BasicRegisters\Value\Municipality\MunicipalityNameDetailInterface
     */
    private $nameDetail;

    /**
     * Constructor.
     *
     * @param \DigipolisGent\Flanders\BasicRegisters\Value\Municipality\MunicipalityNameDetailInterface $nameDetail
     */
    public function __construct(MunicipalityNameDetailInterface $nameDetail)
    {
        $this->nameDetail = $nameDetail;
    }

    /**
     * Get the municipality name detail.
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\Municipality\MunicipalityNameDetailInterface
     */
    public function municipalityNameDetail(): MunicipalityNameDetailInterface
    {
        return $this->nameDetail;
    }
}
