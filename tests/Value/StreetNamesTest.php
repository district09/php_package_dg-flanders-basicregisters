<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Value;

use DigipolisGent\Flanders\BasicRegisters\Value\GeographicalName;
use DigipolisGent\Flanders\BasicRegisters\Value\GeographicalNames;
use DigipolisGent\Flanders\BasicRegisters\Value\LanguageCode;
use DigipolisGent\Flanders\BasicRegisters\Value\StreetName;
use DigipolisGent\Flanders\BasicRegisters\Value\StreetNameId;
use DigipolisGent\Flanders\BasicRegisters\Value\StreetNames;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Value\StreetNames
 */
class StreetNamesTest extends TestCase
{
    /**
     * Casting to string returns all address as string.
     *
     * @test
     */
    public function castToStringReturnsAllPostInfosAsString(): void
    {
        $streetNames = new StreetNames(
            $this->createStreetName(100, 'StreetName 1'),
            $this->createStreetName(200, 'StreetName 2')
        );

        $this->assertEquals(
            'StreetName 1, StreetName 2',
            (string) $streetNames
        );
    }

    /**
     * Create a StreetName object.
     *
     * @param int $identifier
     * @param string $name
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\StreetName
     */
    public function createStreetName(int $identifier, string $name): StreetName
    {
        return new StreetName(
            new StreetNameId($identifier),
            new GeographicalNames(
                new GeographicalName(
                    new LanguageCode('NL'),
                    $name
                )
            )
        );
    }
}
