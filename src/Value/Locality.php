<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Value;

use DigipolisGent\Value\ValueInterface;

/**
 * A locality.
 */
final class Locality extends AbstractWithGeographicalNames
{
    /**
     * The locality id.
     *
     * @var \DigipolisGent\Flanders\BasicRegisters\Value\LocalityId
     */
    private $localityId;

    /**
     * Create a new locality.
     *
     * @param \DigipolisGent\Flanders\BasicRegisters\Value\LocalityId $streetNameId
     * @param \DigipolisGent\Flanders\BasicRegisters\Value\GeographicalNames $geographicalNames
     */
    public function __construct(LocalityId $streetNameId, GeographicalNames $geographicalNames)
    {
        parent::__construct($geographicalNames);
        $this->localityId = $streetNameId;
    }

    /**
     * Get the locality id.
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\LocalityId
     */
    public function localityId(): LocalityId
    {
        return $this->localityId;
    }

    /**
     * @inheritDoc
     */
    public function sameValueAs(ValueInterface $object): bool
    {
        /** @var \DigipolisGent\Flanders\BasicRegisters\Value\Locality $object */
        return parent::sameValueAs($object)
            && $this->localityId()->sameValueAs($object->localityId());
    }
}
