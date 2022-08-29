<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Filter;

use DigipolisGent\Flanders\BasicRegisters\Filter\MunicipalityNisCodeFilter;
use DigipolisGent\Tests\Flanders\BasicRegisters\TestCase;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Filter\MunicipalityNisCodeFilter
 */
class MunicipalityNisCodeFilterTest extends TestCase
{
    /**
     * Filter has proper argument name.
     *
     * @test
     */
    public function hasProperArgumentName(): void
    {
        $filter = new MunicipalityNisCodeFilter('FooBar');

        $this->assertEquals('niscode', $filter->name());
    }
}
