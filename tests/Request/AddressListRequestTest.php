<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Request;

use DigipolisGent\Flanders\BasicRegisters\Filter\FiltersInterface;
use DigipolisGent\Flanders\BasicRegisters\Pager\PagerInterface;
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
            $this->createFiltersMock(),
            $this->createPagerMock()
        );

        $this->assertEquals(
            'adressen?biz=fuzz&baz=123&offset=250&limit=50',
            $request->getRequestTarget()
        );
    }

    /**
     * Create filters mock.
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Filter\FiltersInterface
     */
    private function createFiltersMock(): FiltersInterface
    {
        $filters = $this->prophesize(FiltersInterface::class);
        $filters
            ->filters()
            ->willReturn(
                [
                    'biz' => 'fuzz',
                    'baz' => 123,
                ]
            );

        return $filters->reveal();
    }

    /**
     * Create a pager mock.
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Pager\PagerInterface
     */
    private function createPagerMock(): PagerInterface
    {
        $pager = $this->prophesize(PagerInterface::class);
        $pager
            ->query()
            ->willReturn(
                [
                    'offset' => 250,
                    'limit' => 50,
                ]
            );

        return $pager->reveal();
    }
}
