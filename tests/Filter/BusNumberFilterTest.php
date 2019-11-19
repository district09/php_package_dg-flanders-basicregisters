<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Filter;

use DigipolisGent\Flanders\BasicRegisters\Filter\BusNumberFilter;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Filter\BusNumberFilter
 */
class BusNumberFilterTest extends TestCase
{
    /**
     * Filter has proper argument name.
     *
     * @test
     */
    public function hasProperArgumentName(): void
    {
        $filter = new BusNumberFilter('D');

        $this->assertEquals('busnummer', $filter->name());
    }
}
