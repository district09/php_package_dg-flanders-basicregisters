<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Value;

use DigipolisGent\Flanders\BasicRegisters\Value\GeographicalName;
use DigipolisGent\Flanders\BasicRegisters\Value\GeographicalNames;
use DigipolisGent\Flanders\BasicRegisters\Value\LanguageCode;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Value\AbstractGeographicalNames
 * @covers \DigipolisGent\Flanders\BasicRegisters\Value\GeographicalNames
 */
class GeographicalNamesTest extends TestCase
{

    /**
     * Exception when the collection is created without values.
     *
     * @test
     */
    public function collectionCanNotBeCreatedWithoutValues(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new GeographicalNames();
    }

    /**
     * No GeographicalName translation if it is not available.
     *
     * @test
     */
    public function noGeographicalNameIfTranslationIsNotAvailable(): void
    {
        $geographicalNames = new GeographicalNames(
            new GeographicalName(new LanguageCode('NL'), 'Foo NL')
        );

        $this->assertNull($geographicalNames->translation(new LanguageCode('EN')));
    }

    /**
     * GeographicalName translation is returned if available.
     *
     * @test
     */
    public function geographicalNameIfTranslationIsAvailable(): void
    {
        $geographicalName = new GeographicalName(new LanguageCode('NL'), 'Foo NL');
        $geographicalNames = new GeographicalNames($geographicalName);

        $this->assertSame($geographicalName, $geographicalNames->translation(new LanguageCode('NL')));
    }

    /**
     * Translated name is extracted when available.
     *
     * @test
     */
    public function nameTranslationIsExtractedWhenAvailable(): void
    {
        $geographicalNames = new GeographicalNames(
            new GeographicalName(new LanguageCode('EN'), 'Foo EN'),
            new GeographicalName(new LanguageCode('NL'), 'Foo NL'),
            new GeographicalName(new LanguageCode('FR'), 'Foo FR')
        );

        $this->assertEquals(
            'Foo FR',
            $geographicalNames->translatedName(new LanguageCode('FR'))
        );
    }

    /**
     * Translated name has fallback to dutch if available.
     *
     * @test
     */
    public function nameTranslationHasFallbackToDutchIfAvailable(): void
    {
        $geographicalNames = new GeographicalNames(
            new GeographicalName(new LanguageCode('EN'), 'Foo EN'),
            new GeographicalName(new LanguageCode('NL'), 'Foo NL')
        );

        $this->assertEquals(
            'Foo NL',
            $geographicalNames->translatedName(new LanguageCode('FR'))
        );
    }

    /**
     * Translated name has fallback to first item if dutch is not available.
     *
     * @test
     */
    public function nameTranslationHasFallbackToFirstItemIfDutchIsNotAvailable(): void
    {
        $geographicalNames = new GeographicalNames(
            new GeographicalName(new LanguageCode('EN'), 'Foo EN'),
            new GeographicalName(new LanguageCode('DE'), 'Foo DE')
        );

        $this->assertEquals(
            'Foo EN',
            $geographicalNames->translatedName(new LanguageCode('FR'))
        );
    }

    /**
     * Name is by default extracted from the dutch translation.
     *
     * @test
     */
    public function nameIsExtractedFromDutchTranslation(): void
    {
        $geographicalNames = new GeographicalNames(
            new GeographicalName(new LanguageCode('EN'), 'Foo EN'),
            new GeographicalName(new LanguageCode('NL'), 'Foo NL'),
            new GeographicalName(new LanguageCode('FR'), 'Foo FR')
        );

        $this->assertEquals('Foo NL', $geographicalNames->name());
    }

    /**
     * Casting to string results in the name() value.
     *
     * @test
     */
    public function castToStringReturnsNameMethodValue(): void
    {
        $geographicalNames = new GeographicalNames(
            new GeographicalName(new LanguageCode('NL'), 'Foo NL')
        );

        $this->assertEquals($geographicalNames->name(), (string) $geographicalNames);
    }
}
