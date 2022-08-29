<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Value\Position;

use DigipolisGent\Value\ValueAbstract;
use DigipolisGent\Value\ValueInterface;

/**
 * Abstract implementation of an address position point.
 */
class AbstractPoint extends ValueAbstract implements PointInterface
{
    /**
     * The x-position.
     *
     * @var float
     */
    private $xPosition;

    /**
     * The y-position.
     *
     * @var float
     */
    private $yPosition;

    /**
     * Create a new position object.
     *
     * @param float $xPosition
     * @param float $yPosition
     */
    public function __construct(float $xPosition, float $yPosition)
    {
        $this->xPosition = $xPosition;
        $this->yPosition = $yPosition;
    }

    /**
     * @inheritDoc
     */
    public function xPosition(): float
    {
        return $this->xPosition;
    }

    /**
     * @inheritDoc
     */
    public function yPosition(): float
    {
        return $this->yPosition;
    }

    /**
     * @inheritDoc
     */
    public function sameValueAs(ValueInterface $object): bool
    {
        /** @var \DigipolisGent\Flanders\BasicRegisters\Value\Position\PointInterface $object */
        return $this->sameValueTypeAs($object)
            && $this->xPosition() === $object->xPosition()
            && $this->yPosition() === $object->yPosition();
    }

    /**
     * @inheritDoc
     */
    public function __toString(): string
    {
        return sprintf('%s,%s', (string) $this->xPosition(), (string) $this->yPosition());
    }
}
