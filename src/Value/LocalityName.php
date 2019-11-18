<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Value;

use DigipolisGent\Value\ValueInterface;

/**
 * A locality.
 */
final class LocalityName extends AbstractWithGeographicalName
{
    /**
     * The locality name id.
     *
     * @var \DigipolisGent\Flanders\BasicRegisters\Value\LocalityNameId
     */
    private $localityNameId;

    /**
     * Create a new locality.
     *
     * @param \DigipolisGent\Flanders\BasicRegisters\Value\LocalityNameId $localityNameId
     * @param \DigipolisGent\Flanders\BasicRegisters\Value\GeographicalName $geographicalName
     */
    public function __construct(LocalityNameId $localityNameId, GeographicalName $geographicalName)
    {
        parent::__construct($geographicalName);
        $this->localityNameId = $localityNameId;
    }

    /**
     * Get the locality name id.
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\LocalityNameId
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
        /** @var \DigipolisGent\Flanders\BasicRegisters\Value\LocalityName $object */
        return parent::sameValueAs($object)
            && $this->localityNameId()->sameValueAs($object->localityNameId());
    }
}
