<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Normalize\FromJson\Position;

use DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\Position\Lambert72PointNormalizer;
use DigipolisGent\Flanders\BasicRegisters\Value\Position\Lambert72Point;
use DigipolisGent\Tests\Flanders\BasicRegisters\TestCase;

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
    "adresPositie": {
        "geometrie": {
          "type": "Point",
          "gml": "\u003Cgml:Point srsName=\"https://www.opengis.net/def/crs/EPSG/0/31370\" xmlns:gml=\"http://www.opengis.net/gml/3.2\"\u003E\u003Cgml:pos\u003E105600.61 192113.19\u003C/gml:pos\u003E\u003C/gml:Point\u003E"
        },
        "positieGeometrieMethode": "aangeduidDoorBeheerder",
        "positieSpecificatie": "gebouweenheid"
      }
}
EOT;

    /**
     * Json data is normalized into a Lambert72Point value.
     *
     * @test
     */
    public function jsonDataIsNormalized(): void
    {
        $expected = new Lambert72Point(105600.61, 192113.19);

        $normalizer = new Lambert72PointNormalizer();
        $jsonData = json_decode($this->json);
        $this->assertEquals(
            $expected,
            $normalizer->normalize($jsonData->adresPositie->geometrie)
        );
    }
}
