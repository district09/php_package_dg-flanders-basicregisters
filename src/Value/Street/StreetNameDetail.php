<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Value\Street;

use DigipolisGent\Flanders\BasicRegisters\Value\Geographical\AbstractWithGeographicalNames;
use DigipolisGent\Flanders\BasicRegisters\Value\Geographical\GeographicalNames;
use DigipolisGent\Flanders\BasicRegisters\Value\Municipality\MunicipalityName;
use DigipolisGent\Value\ValueInterface;

/**
 * A Street name.
 */
final class StreetNameDetail extends AbstractWithGeographicalNames
{
    /**
     * The street name id.
     *
     * @var \DigipolisGent\Flanders\BasicRegisters\Value\Street\StreetNameId
     */
    private $streetNameId;

    /**
     * The municipality
     *
     * @var \DigipolisGent\Flanders\BasicRegisters\Value\Municipality\MunicipalityName
     */
    private $municipalityName;

    /**
     * Create a new street name.
     *
     * @param \DigipolisGent\Flanders\BasicRegisters\Value\Street\StreetNameId $municipalityNameId
     * @param \DigipolisGent\Flanders\BasicRegisters\Value\Geographical\GeographicalNames $geographicalNames
     * @param \DigipolisGent\Flanders\BasicRegisters\Value\Municipality\MunicipalityName $municipalityName
     */
    public function __construct(
        StreetNameId $municipalityNameId,
        GeographicalNames $geographicalNames,
        MunicipalityName $municipalityName
    ) {
        parent::__construct($geographicalNames);
        $this->streetNameId = $municipalityNameId;
        $this->municipalityName = $municipalityName;
    }

    /**
     * Get the street name id.
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\Street\StreetNameId
     */
    public function streetNameId(): StreetNameId
    {
        return $this->streetNameId;
    }

    /**
     * Return the municipality name.
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\Municipality\MunicipalityName
     */
    public function municipalityName(): MunicipalityName
    {
        return $this->municipalityName;
    }

    /**
     * @inheritDoc
     */
    public function sameValueAs(ValueInterface $object): bool
    {
        /** @var \DigipolisGent\Flanders\BasicRegisters\Value\Street\StreetNameDetail $object */
        return parent::sameValueAs($object)
            && $this->streetNameId()->sameValueAs($object->streetNameId())
            && $this->municipalityName()->sameValueAs($object->municipalityName());
    }
}
