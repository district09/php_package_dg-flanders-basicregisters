<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Value\Post;

use DigipolisGent\Value\ValueAbstract;
use DigipolisGent\Value\ValueInterface;

/**
 * Post info value.
 */
final class PostInfo extends ValueAbstract implements PostInfoInterface
{
    /**
     * The post info id.
     *
     * @var \DigipolisGent\Flanders\BasicRegisters\Value\Post\PostInfoId
     */
    private $postInfoId;

    /**
     * The post info names.
     *
     * @var \DigipolisGent\Flanders\BasicRegisters\Value\Post\PostInfoNames
     */
    private $postInfoNames;

    /**
     * Create a new post info value.
     *
     * @param \DigipolisGent\Flanders\BasicRegisters\Value\Post\PostInfoId $postInfoId
     * @param \DigipolisGent\Flanders\BasicRegisters\Value\Post\PostInfoNames $postInfoNames
     */
    public function __construct(PostInfoId $postInfoId, PostInfoNames $postInfoNames)
    {
        $this->postInfoId = $postInfoId;
        $this->postInfoNames = $postInfoNames;
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
    public function postInfoNames(): PostInfoNames
    {
        return $this->postInfoNames;
    }

    /**
     * @inheritDoc
     */
    public function name(): string
    {
        return $this->postInfoNames()->name();
    }

    /**
     * @inheritDoc
     */
    public function sameValueAs(ValueInterface $object): bool
    {
        /** @var \DigipolisGent\Flanders\BasicRegisters\Value\Post\PostInfoInterface $object */
        return $this->postInfoId()->sameValueAs($object->postInfoId())
            && $this->postInfoNames()->sameValueAs($object->postInfoNames());
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
