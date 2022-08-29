<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Normalize\FromJson;

use DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\IdExtractor;
use DigipolisGent\Tests\Flanders\BasicRegisters\TestCase;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Normalizer\FromJson\IdExtractor
 */
class IdExtractorTest extends TestCase
{
    /**
     * Json data where the objectId is wrapped by an identificator.
     *
     * @var string
     */
    private $jsonWithWrapper = <<<EOT
{
    "identificator": {
        "id": "https://data.vlaanderen.be/id/straatnaam/69497",
        "naamruimte": "https://data.vlaanderen.be/id/straatnaam",
        "objectId": "69497",
        "versieId": 7
    }
}
EOT;

    /**
     * Json data where the objectId a direct property of the data.
     *
     * @var string
     */
    private $jsonWithProperty = <<<EOT
{
    "objectId": "69497"
}
EOT;

    /**
     * Id is extracted from the wrapper.
     *
     * @test
     */
    public function idIsExtractedFromWrapper(): void
    {
        $idExtractor = new IdExtractor();
        $jsonData = json_decode($this->jsonWithWrapper);

        $this->assertEquals(69497, $idExtractor->extractObjectId($jsonData));
    }

    /**
     * Id is extracted from the property.
     *
     * @test
     */
    public function idIsExtractedFromProperty(): void
    {
        $idExtractor = new IdExtractor();
        $jsonData = json_decode($this->jsonWithProperty);

        $this->assertEquals(69497, $idExtractor->extractObjectId($jsonData));
    }
}
