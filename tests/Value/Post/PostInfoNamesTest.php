<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Value\Post;

use DigipolisGent\Flanders\BasicRegisters\Value\Geographical\GeographicalName;
use DigipolisGent\Flanders\BasicRegisters\Value\LanguageCode;
use DigipolisGent\Flanders\BasicRegisters\Value\Post\PostInfoNames;
use DigipolisGent\Tests\Flanders\BasicRegisters\TestCase;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Value\Post\PostInfoNames
 */
class PostInfoNamesTest extends TestCase
{
    /**
     * Main name is first of collection if none in all caps.
     *
     * @test
     */
    public function mainNameIsFirstItemIfNoneInAllCaps(): void
    {
        $postInfoNames = new PostInfoNames(
            $this->createGeographicalName('foo'),
            $this->createGeographicalName('bar'),
            $this->createGeographicalName('biz'),
            $this->createGeographicalName('baz')
        );

        $this->assertEquals(
            $this->createGeographicalName('foo'),
            $postInfoNames->geographicalName()
        );
        $this->assertEquals(
            'foo',
            $postInfoNames->name()
        );
    }

    /**
     * Main name is the first one written in all caps.
     *
     * The name will be transformed to Capitalized Words.
     *
     * @test
     */
    public function mainNameIsFirstItemInAllCaps(): void
    {
        $postInfoNames = new PostInfoNames(
            $this->createGeographicalName('Foo'),
            $this->createGeographicalName('BAR-TEST'),
            $this->createGeographicalName('BIZ'),
            $this->createGeographicalName('BAZ')
        );

        $this->assertEquals(
            $this->createGeographicalName('Bar-Test'),
            $postInfoNames->geographicalName()
        );
        $this->assertEquals(
            'Bar-Test',
            $postInfoNames->name()
        );
    }

    /**
     * Names array contains all names with main name first.
     *
     * @test
     */
    public function namesArrayHasMainNameFirst(): void
    {
        $postInfoNames = new PostInfoNames(
            $this->createGeographicalName('Foo'),
            $this->createGeographicalName('BAR-TEST'),
            $this->createGeographicalName('Biz'),
            $this->createGeographicalName('Baz')
        );

        $this->assertEquals(
            ['Bar-Test', 'Foo', 'Biz', 'Baz'],
            $postInfoNames->names()
        );
    }

    /**
     * Has no sub municipalities if there is only one name.
     *
     * @test
     */
    public function noSubMunicipalitiesIfThereIsOnlyOneName(): void
    {
        $postInfoNames = new PostInfoNames(
            $this->createGeographicalName('Foo')
        );

        $this->assertFalse($postInfoNames->hasSubMunicipalities());
    }

    /**
     * Has sub municipalities if there is more than one name.
     *
     * @test
     */
    public function hasSubMunicipalitiesIfThereIsMoreThanOneName(): void
    {
        $postInfoNames = new PostInfoNames(
            $this->createGeographicalName('Foo'),
            $this->createGeographicalName('Biz')
        );

        $this->assertTrue($postInfoNames->hasSubMunicipalities());
    }

    /**
     * Cast to string returns main name.
     *
     * @test
     */
    public function castToStringReturnsMainName(): void
    {
        $postInfoNames = new PostInfoNames(
            $this->createGeographicalName('Foo'),
            $this->createGeographicalName('BAR-TEST'),
            $this->createGeographicalName('BIZ'),
            $this->createGeographicalName('BAZ')
        );

        $this->assertEquals(
            'Bar-Test',
            (string) $postInfoNames
        );
    }

    /**
     * Helper to create a geographicalName.
     *
     * @param string $name
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\Geographical\GeographicalName
     */
    private function createGeographicalName($name): GeographicalName
    {
        return new GeographicalName(
            new LanguageCode('NL'),
            $name
        );
    }
}
