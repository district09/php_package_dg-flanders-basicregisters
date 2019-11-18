<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Value\Locality;

use DigipolisGent\Flanders\BasicRegisters\Value\Geographical\AbstractWithGeographicalName;
use DigipolisGent\Flanders\BasicRegisters\Value\Geographical\GeographicalName;
use DigipolisGent\Value\ValueInterface;

/**
 * A locality.
 */
final class LocalityName extends AbstractWithGeographicalName
{
    /**
     * The locality name id.
     *
     * @var \DigipolisGent\Flanders\BasicRegisters\Value\Locality\Locality\LocalityNameId
     */
    private $localityNameId;

    /**
     * Create a new locality.
     *
     * @param \DigipolisGent\Flanders\BasicRegisters\Value\Locality\LocalityNameId $localityNameId
     * @param \DigipolisGent\Flanders\BasicRegisters\Value\Geographical\GeographicalName $geographicalName
     */
    public function __construct(LocalityNameId $localityNameId, GeographicalName $geographicalName)
    {
        parent::__construct($geographicalName);
        $this->localityNameId = $localityNameId;
    }

    /**
     * Get the locality name id.
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\Locality\LocalityNameId
     */
    public function localityNameId(): LocalityNameId
    {
        return $this->localityNameId;
    }

    /**
     * @inheritDoc
     */
    public function sameValueAs(ValueInterface $object): bool
    {
        /** @var \DigipolisGent\Flanders\BasicRegisters\Value\Locality\LocalityName $object */
        return parent::sameValueAs($object)
            && $this->localityNameId()->sameValueAs($object->localityNameId());
    }
}
