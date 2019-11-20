<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Value\Municipality;

use DigipolisGent\Flanders\BasicRegisters\Value\Geographical\AbstractWithGeographicalName;
use DigipolisGent\Flanders\BasicRegisters\Value\Geographical\GeographicalName;
use DigipolisGent\Value\ValueInterface;

/**
 * A municipality.
 */
final class MunicipalityName extends AbstractWithGeographicalName
{
    /**
     * The municipality name id.
     *
     * @var \DigipolisGent\Flanders\BasicRegisters\Value\Municipality\MunicipalityNameId
     */
    private $municipalityNameId;

    /**
     * Create a new municipality.
     *
     * @param \DigipolisGent\Flanders\BasicRegisters\Value\Municipality\MunicipalityNameId $municipalityNameId
     * @param \DigipolisGent\Flanders\BasicRegisters\Value\Geographical\GeographicalName $geographicalName
     */
    public function __construct(MunicipalityNameId $municipalityNameId, GeographicalName $geographicalName)
    {
        parent::__construct($geographicalName);
        $this->municipalityNameId = $municipalityNameId;
    }

    /**
     * Get the municipality name id.
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\Municipality\MunicipalityNameId
     */
    public function municipalityNameId(): MunicipalityNameId
    {
        return $this->municipalityNameId;
    }

    /**
     * @inheritDoc
     */
    public function sameValueAs(ValueInterface $object): bool
    {
        /** @var \DigipolisGent\Flanders\BasicRegisters\Value\Municipality\MunicipalityName $object */
        return parent::sameValueAs($object)
            && $this->municipalityNameId()->sameValueAs($object->municipalityNameId());
    }
}
