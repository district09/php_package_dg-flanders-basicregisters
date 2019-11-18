<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Value;

use DigipolisGent\Flanders\BasicRegisters\Value\GeographicalName;
use DigipolisGent\Flanders\BasicRegisters\Value\LanguageCode;
use DigipolisGent\Flanders\BasicRegisters\Value\LocalityNames;
use DigipolisGent\Flanders\BasicRegisters\Value\LocalityName;
use DigipolisGent\Flanders\BasicRegisters\Value\LocalityNameId;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Value\LocalityNames
 */
class LocalityNamesTest extends TestCase
{
    /**
     * Casting to string returns all locality names as string.
     *
     * @test
     */
    public function castToStringReturnsAllLocalityNamesAsString(): void
    {
        $localityNames = new LocalityNames(
            $this->createLocalityName(100, 'Locality 1'),
            $this->createLocalityName(200, 'Locality 2')
        );

        $this->assertEquals(
            'Locality 1, Locality 2',
            (string) $localityNames
        );
    }

    /**
     * Create a Locality name object.
     *
     * @param int $identifier
     * @param string $name
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\LocalityName
     */
    public function createLocalityName(int $identifier, string $name): LocalityName
    {
        return new LocalityName(
            new LocalityNameId($identifier),
            new GeographicalName(
                new LanguageCode('NL'),
                $name
            )
        );
    }
}
