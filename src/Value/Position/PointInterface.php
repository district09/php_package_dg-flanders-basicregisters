<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Value\Position;

use DigipolisGent\Value\ValueInterface;

/**
 * Interface for address position point.
 */
interface PointInterface extends ValueInterface
{
    /**
     * Get the x position.
     *
     * @return float
     */
    public function xPosition(): float;

    /**
     * Get the y position.
     *
     * @return float
     */
    public function yPosition(): float;
}
