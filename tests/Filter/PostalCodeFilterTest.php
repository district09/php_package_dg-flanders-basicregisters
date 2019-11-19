<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Filter;

use DigipolisGent\Flanders\BasicRegisters\Filter\PostalCodeFilter;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Filter\PostalCodeFilter
 */
class PostalCodeFilterTest extends TestCase
{
    /**
     * Filter has proper argument name.
     *
     * @test
     */
    public function hasProperArgumentName(): void
    {
        $filter = new PostalCodeFilter(9000);

        $this->assertEquals('postcode', $filter->name());
    }
}
