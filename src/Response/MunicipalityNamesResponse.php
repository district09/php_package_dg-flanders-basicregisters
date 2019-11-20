<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Response;

use DigipolisGent\API\Client\Response\ResponseInterface;
use DigipolisGent\Flanders\BasicRegisters\Value\Municipality\MunicipalityNames;

/**
 * Response containing the list of municipality name values.
 */
final class MunicipalityNamesResponse implements ResponseInterface
{
    /**
     * Municpality names.
     *
     * @var \DigipolisGent\Flanders\BasicRegisters\Value\Municipality\MunicipalityNames
     */
    private $municipalityNames;

    /**
     * Constructor.
     *
     * @param \DigipolisGent\Flanders\BasicRegisters\Value\Municipality\MunicipalityNames
     */
    public function __construct(MunicipalityNames $municipalityNames)
    {
        $this->municipalityNames = $municipalityNames;
    }

    /**
     * Get the addresses.
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\Municipality\MunicipalityNames
     */
    public function municipalityNames(): MunicipalityNames
    {
        return $this->municipalityNames;
    }
}
