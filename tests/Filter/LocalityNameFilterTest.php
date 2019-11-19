<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Filter;

use DigipolisGent\Flanders\BasicRegisters\Filter\LocalityNameFilter;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Filter\AbstractFilter
 * @covers \DigipolisGent\Flanders\BasicRegisters\Filter\LocalityNameFilter
 */
class LocalityNameFilterTest extends TestCase
{
    /**
     * The value is passed trough the constructor.
     *
     * @test
     */
    public function valueIsPassedTroughTheConstructor(): void
    {
        $filter = new LocalityNameFilter('FooBar');

        $this->assertEquals('FooBar', $filter->value());
    }

    /**
     * Filter has proper argument name.
     *
     * @test
     */
    public function hasProperArgumentName(): void
    {
        $filter = new LocalityNameFilter('FooBar');

        $this->assertEquals('gemeentenaam', $filter->name());
    }
}
