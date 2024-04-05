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
        $pattern = '/<gml:Point.*><gml:pos>(.*) (.*)<\/gml:pos><\/gml:Point>/';
        $matches = [];
        preg_match($pattern, $jsonData->gml, $matches);
        $points = [(float)$matches[1], (float)$matches[2]];

        return new Lambert72Point(
            $points[0],
            $points[1]
        );
    }
}
