<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Value\Municipality;

use DigipolisGent\Flanders\BasicRegisters\Value\Geographical\GeographicalName;
use DigipolisGent\Flanders\BasicRegisters\Value\LanguageCode;
use DigipolisGent\Flanders\BasicRegisters\Value\Municipality\MunicipalityNames;
use DigipolisGent\Flanders\BasicRegisters\Value\Municipality\MunicipalityName;
use DigipolisGent\Flanders\BasicRegisters\Value\Municipality\MunicipalityNameId;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Value\Municipality\MunicipalityNames
 */
class MunicipalityNamesTest extends TestCase
{
    /**
     * Casting to string returns all municipality names as string.
     *
     * @test
     */
    public function castToStringReturnsAllMunicipalityNamesAsString(): void
    {
        $municipalityNames = new MunicipalityNames(
            $this->createMunicipalityName(100, 'Municipality 1'),
            $this->createMunicipalityName(200, 'Municipality 2')
        );

        $this->assertEquals(
            'Municipality 1, Municipality 2',
            (string) $municipalityNames
        );
    }

    /**
     * Create a Municipality name object.
     *
     * @param int $identifier
     * @param string $name
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\Municipality\MunicipalityName
     */
    public function createMunicipalityName(int $identifier, string $name): MunicipalityName
    {
        return new MunicipalityName(
            new MunicipalityNameId($identifier),
            new GeographicalName(
                new LanguageCode('NL'),
                $name
            )
        );
    }
}
