<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Value\Locality;

use DigipolisGent\Flanders\BasicRegisters\Value\Geographical\AbstractWithGeographicalNames;
use DigipolisGent\Value\ValueInterface;

/**
 * A Street name.
 */
final class LocalityNameDetail extends AbstractWithGeographicalNames
{
    /**
     * The locality name id.
     *
     * @var \DigipolisGent\Flanders\BasicRegisters\Value\Locality\LocalityNameDetail
     */
    private $localityNameId;

    /**
     * Create a new locality name detail.
     *
     * @param \DigipolisGent\Flanders\BasicRegisters\Value\Locality\LocalityNameId $localityNameId
     * @param \DigipolisGent\Flanders\BasicRegisters\Value\Geographical\GeographicalNames $geographicalNames
     */
    public function __construct(
        LocalityNameId $localityNameId,
        GeographicalNames $geographicalNames
    ) {
        parent::__construct($geographicalNames);
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
        /** @var \DigipolisGent\Flanders\BasicRegisters\Value\Locality\LocalityNameDetail $object */
        return parent::sameValueAs($object)
            && $this->localityNameId()->sameValueAs($object->localityNameId());
    }
}
