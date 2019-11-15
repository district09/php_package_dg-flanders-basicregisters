<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Value;

use DigipolisGent\Value\ValueAbstract;
use DigipolisGent\Value\ValueInterface;

/**
 * A post info id + locality.
 */
final class Locality extends ValueAbstract
{
    /**
     * The post info id (postal code).
     *
     * @var \DigipolisGent\Flanders\BasicRegisters\Value\PostInfoId
     */
    private $postInfoId;

    /**
     * The locality name.
     *
     * @var \DigipolisGent\Flanders\BasicRegisters\Value\LocalityName
     */
    private $localityName;

    /**
     * Create a new value.
     *
     * @param \DigipolisGent\Flanders\BasicRegisters\Value\PostInfoId $postInfoId
     * @param \DigipolisGent\Flanders\BasicRegisters\Value\LocalityName $localityName
     */
    public function __construct(PostInfoId $postInfoId, LocalityName $localityName)
    {
        $this->postInfoId = $postInfoId;
        $this->localityName = $localityName;
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
     * Get the locality.
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\LocalityName
     */
    public function localityName(): LocalityName
    {
        return $this->localityName;
    }

    /**
     * Get the locality name.
     *
     * @return string
     */
    public function name(): string
    {
        return $this->localityName()->name();
    }

    /**
     * @inheritDoc
     */
    public function sameValueAs(ValueInterface $object): bool
    {
        /** @var \DigipolisGent\Flanders\BasicRegisters\Value\Locality $object */
        return $this->sameValueTypeAs($object)
            && $this->postInfoId()->sameValueAs($object->postInfoId())
            && $this->localityName()->sameValueAs($object->localityName());
    }

    /**
     * @inheritDoc
     *
     * This will return "[postal code] [locality name]".
     */
    public function __toString(): string
    {
        return sprintf('%d %s', $this->postalCode(), $this->name());
    }
}
