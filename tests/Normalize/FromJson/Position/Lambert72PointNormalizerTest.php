<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Normalize\FromJson\Position;

use DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\Position\Lambert72PointNormalizer;
use DigipolisGent\Flanders\BasicRegisters\Value\Position\Lambert72Point;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\Position\Lambert72PointNormalizer
 */
class Lambert72PointNormalizerTest extends TestCase
{
    /**
     * Json data to test with.
     *
     * @var string
     */
    private $json = <<<EOT
{
    "coordinates": [
        105595.28,
        192122.78
    ],
    "type": "Point"
}
EOT;

    /**
     * Json data is normalized into a Lambert72Point value.
     *
     * @test
     */
    public function jsonDataIsNormalized(): void
    {
        $expected = new Lambert72Point(105595.28, 192122.78);

        $normalizer = new Lambert72PointNormalizer();
        $jsonData = json_decode($this->json);

        $this->assertEquals(
            $expected,
            $normalizer->normalize($jsonData)
        );
    }
}
