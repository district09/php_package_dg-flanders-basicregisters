<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Uri;

use DigipolisGent\Flanders\BasicRegisters\Filter\FilterInterface;
use DigipolisGent\Flanders\BasicRegisters\Filter\Filters;
use DigipolisGent\Flanders\BasicRegisters\Pager\Pager;
use DigipolisGent\Flanders\BasicRegisters\Uri\AddressesUri;
use PHPStan\Testing\TestCase;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Uri\AbstractUriWithFiltersAndPager
 * @covers \DigipolisGent\Flanders\BasicRegisters\Uri\AddressesUri
 */
class AddressesUriTest extends TestCase
{
    /**
     * URI without filters
     *
     * @test
     */
    public function uriWithoutFilters(): void
    {
        $uri = new AddressesUri();
        $this->assertEquals('adressen', $uri->getUri());
    }

    /**
     * URI with filters.
     *
     * @test
     */
    public function uriWithFilters(): void
    {
        $filters = new Filters(
            $this->createFilterMock('biz', 'fuzz'),
            $this->createFilterMock('baz', 123)
        );
        $pager = new Pager(5, 50);

        $uri = new AddressesUri($filters, $pager);
        $this->assertSame(
            'adressen?biz=fuzz&baz=123&offset=5&limit=50',
            $uri->getUri()
        );
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
