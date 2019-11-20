<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Filter;

use DigipolisGent\Flanders\BasicRegisters\Filter\StreetPatrimonyCodeFilter;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Filter\StreetPatrimonyCodeFilter
 */
class StreetPatrimonyCodeFilterTest extends TestCase
{
    /**
     * Filter has proper argument name.
     *
     * @test
     */
    public function hasProperArgumentName(): void
    {
        $filter = new StreetPatrimonyCodeFilter('FooBar');

        $this->assertEquals('kadStraatcode', $filter->name());
    }
}
