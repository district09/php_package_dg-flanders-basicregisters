<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Value\Municipality;

use DigipolisGent\Flanders\BasicRegisters\Value\Geographical\AbstractWithGeographicalNames;
use DigipolisGent\Flanders\BasicRegisters\Value\Geographical\GeographicalNames;
use DigipolisGent\Value\ValueInterface;

/**
 * A municipality detail value.
 */
final class MunicipalityNameDetail extends AbstractWithGeographicalNames implements MunicipalityNameDetailInterface
{
    /**
     * The municipality name id.
     *
     * @var \DigipolisGent\Flanders\BasicRegisters\Value\Municipality\MunicipalityNameId
     */
    private $municipalityNameId;

    /**
     * Create a new municipality name detail.
     *
     * @param \DigipolisGent\Flanders\BasicRegisters\Value\Municipality\MunicipalityNameId $municipalityNameId
     * @param \DigipolisGent\Flanders\BasicRegisters\Value\Geographical\GeographicalNames $geographicalNames
     */
    public function __construct(
        MunicipalityNameId $municipalityNameId,
        GeographicalNames $geographicalNames
    ) {
        parent::__construct($geographicalNames);
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
        /** @var \DigipolisGent\Flanders\BasicRegisters\Value\Municipality\MunicipalityNameDetailInterface $object */
        return parent::sameValueAs($object)
            && $this->municipalityNameId()->sameValueAs($object->municipalityNameId());
    }
}
