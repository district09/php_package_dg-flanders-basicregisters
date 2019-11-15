<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Value;

use DigipolisGent\Value\ValueInterface;

/**
 * A Street name.
 */
final class StreetName extends AbstractWithGeographicalNames
{
    /**
     * The street name id.
     *
     * @var \DigipolisGent\Flanders\BasicRegisters\Value\StreetNameId
     */
    private $streetNameId;

    /**
     * Create a new street name.
     *
     * @param \DigipolisGent\Flanders\BasicRegisters\Value\StreetNameId $streetNameId
     * @param \DigipolisGent\Flanders\BasicRegisters\Value\GeographicalNames $geographicalNames
     */
    public function __construct(StreetNameId $streetNameId, GeographicalNames $geographicalNames)
    {
        parent::__construct($geographicalNames);
        $this->streetNameId = $streetNameId;
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
     * @inheritDoc
     */
    public function sameValueAs(ValueInterface $object): bool
    {
        /** @var \DigipolisGent\Flanders\BasicRegisters\Value\StreetName $object */
        return parent::sameValueAs($object)
            && $this->streetNameId()->sameValueAs($object->streetNameId());
    }
}
