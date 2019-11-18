<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Value\Street;

use DigipolisGent\Flanders\BasicRegisters\Value\GeographicalName;
use DigipolisGent\Flanders\BasicRegisters\Value\LanguageCode;
use DigipolisGent\Flanders\BasicRegisters\Value\Street\StreetName;
use DigipolisGent\Flanders\BasicRegisters\Value\Street\StreetNameId;
use DigipolisGent\Flanders\BasicRegisters\Value\Street\StreetNames;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Value\Street\StreetNames
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
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\Street\StreetName
     */
    public function createStreetName(int $identifier, string $name): StreetName
    {
        return new StreetName(
            new StreetNameId($identifier),
            new GeographicalName(
                new LanguageCode('NL'),
                $name
            )
        );
    }
}
