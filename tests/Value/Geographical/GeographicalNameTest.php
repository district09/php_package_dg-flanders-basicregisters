<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Value\Geographical;

use DigipolisGent\Flanders\BasicRegisters\Value\Geographical\GeographicalName;
use DigipolisGent\Flanders\BasicRegisters\Value\LanguageCode;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Value\Geographical\GeographicalName
 */
class GeographicalNameTest extends TestCase
{
    /**
     * Geographical name is created from language code and spelling.
     *
     * @test
     */
    public function createdFromLanguageCodeAndSpelling(): void
    {
        $languageCode = new LanguageCode('EN');
        $geographicalName = new GeographicalName($languageCode, 'foo name');

        $this->assertSame($languageCode, $geographicalName->languageCode());
        $this->assertSame('foo name', $geographicalName->spelling());
    }

    /**
     * Not the same if the values have a different language.
     *
     * @test
     */
    public function notSameIfDifferentLanguage(): void
    {
        $geographicalName = new GeographicalName(new LanguageCode('EN'), 'Foo');
        $otherGeographicalName = new GeographicalName(new LanguageCode('NL'), 'Foo');

        $this->assertFalse($geographicalName->sameValueAs($otherGeographicalName));
    }

    /**
     * Not the same if the values have a different spelling.
     *
     * @test
     */
    public function notSameIfDifferentSpelling(): void
    {
        $geographicalName = new GeographicalName(new LanguageCode('EN'), 'Foo');
        $otherGeographicalName = new GeographicalName(new LanguageCode('EN'), 'Bar');

        $this->assertFalse($geographicalName->sameValueAs($otherGeographicalName));
    }

    /**
     * Same if the values have a same language and spelling.
     *
     * @test
     */
    public function sameIfLanguageAndSpellingIsSame(): void
    {
        $geographicalName = new GeographicalName(new LanguageCode('EN'), 'Foo');
        $sameGeographicalName = new GeographicalName(new LanguageCode('EN'), 'Foo');

        $this->assertTrue($geographicalName->sameValueAs($sameGeographicalName));
    }

    /**
     * Casting to string results in the spelling value.
     *
     * @test
     */
    public function castToStringReturnsSpelling(): void
    {
        $geographicalName = new GeographicalName(new LanguageCode('EN'), 'Foo');
        $this->assertSame('Foo', (string) $geographicalName);
    }
}
