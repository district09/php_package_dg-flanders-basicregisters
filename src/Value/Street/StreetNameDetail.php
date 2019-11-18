<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Value\Street;

use DigipolisGent\Flanders\BasicRegisters\Value\AbstractWithGeographicalNames;
use DigipolisGent\Flanders\BasicRegisters\Value\GeographicalNames;
use DigipolisGent\Flanders\BasicRegisters\Value\Locality\LocalityName;
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
     * The locality
     *
     * @var \DigipolisGent\Flanders\BasicRegisters\Value\Locality\LocalityName
     */
    private $localityName;

    /**
     * Create a new street name.
     *
     * @param \DigipolisGent\Flanders\BasicRegisters\Value\Street\StreetNameId $localityNameId
     * @param \DigipolisGent\Flanders\BasicRegisters\Value\GeographicalNames $geographicalNames
     * @param \DigipolisGent\Flanders\BasicRegisters\Value\Locality\LocalityName $localityName
     */
    public function __construct(
        StreetNameId $localityNameId,
        GeographicalNames $geographicalNames,
        LocalityName $localityName
    ) {
        parent::__construct($geographicalNames);
        $this->streetNameId = $localityNameId;
        $this->localityName = $localityName;
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
     * Return the locality name.
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\Locality\LocalityName
     */
    public function localityName(): LocalityName
    {
        return $this->localityName;
    }

    /**
     * @inheritDoc
     */
    public function sameValueAs(ValueInterface $object): bool
    {
        /** @var \DigipolisGent\Flanders\BasicRegisters\Value\Street\StreetNameDetail $object */
        return parent::sameValueAs($object)
            && $this->streetNameId()->sameValueAs($object->streetNameId())
            && $this->localityName()->sameValueAs($object->localityName());
    }
}
