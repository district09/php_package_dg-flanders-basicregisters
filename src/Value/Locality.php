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
     * The post info id (postal code).
     *
     * @var \DigipolisGent\Flanders\BasicRegisters\Value\PostInfoId
     */
    private $postInfoId;

    /**
     * Create a new locality.
     *
     * @param \DigipolisGent\Flanders\BasicRegisters\Value\LocalityId $localityId
     * @param \DigipolisGent\Flanders\BasicRegisters\Value\GeographicalNames $geographicalNames
     * @param \DigipolisGent\Flanders\BasicRegisters\Value\PostInfoId $postInfoId
     */
    public function __construct(LocalityId $localityId, GeographicalNames $geographicalNames, PostInfoId $postInfoId)
    {
        parent::__construct($geographicalNames);
        $this->localityId = $localityId;
        $this->postInfoId = $postInfoId;
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
     * Get the post info id.
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\PostInfoId
     */
    public function postInfoId(): PostInfoId
    {
        return $this->postInfoId;
    }

    /**
     * Get the postal code.
     *
     * @return int
     */
    public function postalCode(): int
    {
        return $this->postInfoId()->value();
    }

    /**
     * @inheritDoc
     */
    public function sameValueAs(ValueInterface $object): bool
    {
        /** @var \DigipolisGent\Flanders\BasicRegisters\Value\Locality $object */
        return parent::sameValueAs($object)
            && $this->localityId()->sameValueAs($object->localityId())
            && $this->postInfoId()->sameValueAs($object->postInfoId());
    }

    /**
     * @inheritDoc
     *
     * This will return "[postal code] name".
     */
    public function __toString(): string
    {
        return sprintf('%d %s', $this->postalCode(), $this->name());
    }
}
