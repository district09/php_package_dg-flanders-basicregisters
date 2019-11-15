<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Value;

use DigipolisGent\Flanders\BasicRegisters\Value\GeographicalName;
use DigipolisGent\Flanders\BasicRegisters\Value\GeographicalNames;
use DigipolisGent\Flanders\BasicRegisters\Value\LanguageCode;
use DigipolisGent\Flanders\BasicRegisters\Value\Localities;
use DigipolisGent\Flanders\BasicRegisters\Value\Locality;
use DigipolisGent\Flanders\BasicRegisters\Value\LocalityId;
use DigipolisGent\Flanders\BasicRegisters\Value\PostInfoId;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Value\Localities
 */
class LocalitiesTest extends TestCase
{
    /**
     * Casting to string returns all address as string.
     *
     * @test
     */
    public function castToStringReturnsAllPostInfosAsString(): void
    {
        $localities = new Localities(
            $this->createLocality(100, 'Locality 1', 9010),
            $this->createLocality(200, 'Locality 2', 9020)
        );

        $this->assertEquals(
            '9010 Locality 1, 9020 Locality 2',
            (string) $localities
        );
    }

    /**
     * Create an Locality object.
     *
     * @param int $identifier
     * @param string $name
     * @param int $postInfoIdentifier
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\Locality
     */
    public function createLocality(int $identifier, string $name, int $postInfoIdentifier): Locality
    {
        return new Locality(
            new LocalityId($identifier),
            new GeographicalNames(
                new GeographicalName(
                    new LanguageCode('NL'),
                    $name
                )
            ),
            new PostInfoId($postInfoIdentifier)
        );
    }
}
