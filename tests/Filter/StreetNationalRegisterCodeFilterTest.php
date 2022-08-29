<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Filter;

use DigipolisGent\Flanders\BasicRegisters\Filter\StreetNationalRegisterCodeFilter;
use DigipolisGent\Tests\Flanders\BasicRegisters\TestCase;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Filter\StreetNationalRegisterCodeFilter
 */
class StreetNationalRegisterCodeFilterTest extends TestCase
{
    /**
     * Filter has proper argument name.
     *
     * @test
     */
    public function hasProperArgumentName(): void
    {
        $filter = new StreetNationalRegisterCodeFilter('FooBar');

        $this->assertEquals('rrStraatcode', $filter->name());
    }
}
