<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\Position;

use DigipolisGent\Flanders\BasicRegisters\Value\Position\Lambert72Point;

/**
 * Normalizes json data into a Lambert72Point value.
 */
class Lambert72PointNormalizer
{
    /**
     * Normalize json data.
     *
     * @param object $jsonData
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\Position\Lambert72Point
     */
    public function normalize(object $jsonData): Lambert72Point
    {
        return new Lambert72Point(
            (float) $jsonData->coordinates[0],
            (float) $jsonData->coordinates[1]
        );
    }
}
