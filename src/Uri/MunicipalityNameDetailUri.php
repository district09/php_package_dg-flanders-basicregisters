<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Uri;

use DigipolisGent\API\Client\Uri\UriInterface;
use DigipolisGent\Flanders\BasicRegisters\Value\Municipality\MunicipalityNameId;

/**
 * URI to get the municipality name detail.
 */
class MunicipalityNameDetailUri implements UriInterface
{
    /**
     * The MunicipalityNameId.
     *
     * @var \DigipolisGent\Flanders\BasicRegisters\Value\Municipality\MunicipalityNameId
     */
    private $municipalityNameId;

    /**
     * Create a new URI by passing the MunicipalityNameId value.
     *
     * @param \DigipolisGent\Flanders\BasicRegisters\Value\Municipality\MunicipalityNameId $municipalityNameId
     */
    public function __construct(MunicipalityNameId $municipalityNameId)
    {
        $this->municipalityNameId = $municipalityNameId;
    }

    /**
     * @inheritDoc
     */
    public function getUri(): string
    {
        return sprintf('gemeenten/%d', $this->municipalityNameId->value());
    }
}
