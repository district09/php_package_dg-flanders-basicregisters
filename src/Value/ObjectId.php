<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Value;

use DigipolisGent\Value\ValueAbstract;
use DigipolisGent\Value\ValueInterface;
use Webmozart\Assert\Assert;

/**
 * An id object.
 */
class ObjectId extends ValueAbstract
{

    /**
     * The object id value.
     *
     * @var int
     */
    private $objectId;

    /**
     * Create a new Id object from its integer value.
     *
     * @param int $objectId
     *   The id value.
     */
    public function __construct(int $objectId)
    {
        Assert::greaterThan($objectId, 0);
        $this->objectId = $objectId;
    }

    /**
     * Get the id value.
     *
     * @return int
     */
    public function value(): int
    {
        return $this->objectId;
    }

    /**
     * @inheritDoc
     */
    public function sameValueAs(ValueInterface $object)
    {
        /** @var \DigipolisGent\Flanders\BasicRegisters\Value\ObjectId $object */
        return $this->sameValueTypeAs($object)
            && $this->value() === $object->value();
    }

    /**
     * @inheritDoc
     */
    public function __toString()
    {
        return (string) $this->value();
    }
}
