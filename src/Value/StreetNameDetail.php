<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Value;

use DigipolisGent\Value\ValueInterface;

/**
 * A Street name.
 */
final class StreetNameDetail extends AbstractWithGeographicalNames
{
    /**
     * The street name id.
     *
     * @var \DigipolisGent\Flanders\BasicRegisters\Value\StreetNameId
     */
    private $streetNameId;

    /**
     * The locality
     *
     * @var \DigipolisGent\Flanders\BasicRegisters\Value\Locality
     */
    private $locality;

    /**
     * Create a new street name.
     *
     * @param \DigipolisGent\Flanders\BasicRegisters\Value\StreetNameId $streetNameId
     * @param \DigipolisGent\Flanders\BasicRegisters\Value\GeographicalNames $geographicalNames
     * @param \DigipolisGent\Flanders\BasicRegisters\Value\Locality $locality
     */
    public function __construct(StreetNameId $streetNameId, GeographicalNames $geographicalNames, Locality $locality)
    {
        parent::__construct($geographicalNames);
        $this->streetNameId = $streetNameId;
        $this->locality = $locality;
    }

    /**
     * Get the street name id.
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\StreetNameId
     */
    public function streetNameId(): StreetNameId
    {
        return $this->streetNameId;
    }

    /**
     * Return the locality.
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\Locality
     */
    public function locality(): Locality
    {
        return $this->locality;
    }

    /**
     * @inheritDoc
     */
    public function sameValueAs(ValueInterface $object): bool
    {
        /** @var \DigipolisGent\Flanders\BasicRegisters\Value\StreetNameDetail $object */
        return parent::sameValueAs($object)
            && $this->streetNameId()->sameValueAs($object->streetNameId())
            && $this->locality()->sameValueAs($object->locality());
    }
}
