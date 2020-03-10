<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Filter;

use DigipolisGent\Flanders\BasicRegisters\Filter\FilterInterface;
use DigipolisGent\Flanders\BasicRegisters\Filter\Filters;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Filter\Filters
 */
class FiltersTest extends TestCase
{
    /**
     * Collection returns filters as array.
     *
     * @test
     */
    public function filtersAreReturnedAsArray(): void
    {
        $filters = new Filters(
            $this->createFilterMock('Biz', 'Foo'),
            $this->createFilterMock('Baz', 123)
        );

        $expected = [
            'Biz' => 'Foo',
            'Baz' => 123,
        ];
        $this->assertEquals($expected, $filters->filters());
    }

    /**
     * NULL values are casted to empty strings.
     *
     * @test
     */
    public function filterValuesAreCastedToString(): void
    {
        $filters = new Filters(
            $this->createFilterMock('Biz', ''),
            $this->createFilterMock('Baz', null)
        );

        $expected = [
            'Biz' => '',
            'Baz' => '',
        ];
        $this->assertSame($expected, $filters->filters());
    }

    /**
     * Create filter mock.
     *
     * @param string $name
     * @param mixed $value
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Filter\FilterInterface
     */
    private function createFilterMock(string $name, $value): FilterInterface
    {
        $filter = $this->prophesize(FilterInterface::class);
        $filter->name()->willReturn($name);
        $filter->value()->willReturn($value);

        return $filter->reveal();
    }
}
