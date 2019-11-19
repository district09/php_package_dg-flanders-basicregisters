<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Request;

use DigipolisGent\Flanders\BasicRegisters\Filter\FilterInterface;
use DigipolisGent\Flanders\BasicRegisters\Filter\Filters;
use DigipolisGent\Flanders\BasicRegisters\Pager\Pager;
use DigipolisGent\Flanders\BasicRegisters\Request\AddressListRequest;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Request\AddressListRequest
 */
class AddressListRequestTest extends TestCase
{
    /**
     * The URI is set.
     *
     * @test
     */
    public function defaultUriWithoutFilters(): void
    {
        $request = new AddressListRequest();
        $this->assertEquals('adressen', $request->getRequestTarget());
    }

    /**
     * Has URI with query when filters are passed.
     *
     * @test
     */
    public function uriWithFiltersAndPager(): void
    {
        $request = new AddressListRequest(
            new Filters(
                $this->createFilterMock('biz', 'fizz'),
                $this->createFilterMock('baz', 345)
            ),
            new Pager(50, 100)
        );

        $this->assertEquals(
            'adressen?biz=fizz&baz=345&offset=50&limit=100',
            $request->getRequestTarget()
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
