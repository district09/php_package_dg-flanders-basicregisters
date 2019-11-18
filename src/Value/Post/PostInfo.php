<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Value\Post;

use DigipolisGent\Flanders\BasicRegisters\Value\Geographical\AbstractWithGeographicalNames;
use DigipolisGent\Flanders\BasicRegisters\Value\Geographical\GeographicalNames;
use DigipolisGent\Value\ValueInterface;

/**
 * Post info value.
 */
final class PostInfo extends AbstractWithGeographicalNames
{
    /**
     * The post info id.
     *
     * @var \DigipolisGent\Flanders\BasicRegisters\Value\Post\PostInfoId
     */
    private $postInfoId;

    /**
     * Create a new post info value.
     *
     * @param \DigipolisGent\Flanders\BasicRegisters\Value\Post\PostInfoId $postInfoId
     * @param \DigipolisGent\Flanders\BasicRegisters\Value\Geographical\GeographicalNames $geoGraphicalNames
     */
    public function __construct(PostInfoId $postInfoId, GeographicalNames $geoGraphicalNames)
    {
        parent::__construct($geoGraphicalNames);

        $this->postInfoId = $postInfoId;
    }

    /**
     * Get the post info id.
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\Post\PostInfoId
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
        /** @var \DigipolisGent\Flanders\BasicRegisters\Value\Post\PostInfo $object */
        return parent::sameValueAs($object)
            && $this->postInfoId()->sameValueAs($object->postInfoId());
    }

    /**
     * @inheritDoc
     *
     * Will return: "[postal code] [name]".
     */
    public function __toString(): string
    {
        return sprintf('%d %s', $this->postalCode(), $this->name());
    }
}
