<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Value\Street;

use DigipolisGent\Flanders\BasicRegisters\Value\AbstractWithGeographicalName;
use DigipolisGent\Flanders\BasicRegisters\Value\GeographicalName;
use DigipolisGent\Value\ValueInterface;

/**
 * A Street name.
 */
final class StreetName extends AbstractWithGeographicalName
{
    /**
     * The street name id.
     *
     * @var \DigipolisGent\Flanders\BasicRegisters\Value\Street\StreetNameId
     */
    private $streetNameId;

    /**
     * Create a new street name.
     *
     * @param \DigipolisGent\Flanders\BasicRegisters\Value\Street\StreetNameId $streetNameNameId
     * @param \DigipolisGent\Flanders\BasicRegisters\Value\GeographicalName $geographicalName
     */
    public function __construct(StreetNameId $streetNameNameId, GeographicalName $geographicalName)
    {
        parent::__construct($geographicalName);
        $this->streetNameId = $streetNameNameId;
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
     * @inheritDoc
     */
    public function sameValueAs(ValueInterface $object): bool
    {
        /** @var \DigipolisGent\Flanders\BasicRegisters\Value\Street\StreetName $object */
        return parent::sameValueAs($object)
            && $this->streetNameId()->sameValueAs($object->streetNameId());
    }
}
