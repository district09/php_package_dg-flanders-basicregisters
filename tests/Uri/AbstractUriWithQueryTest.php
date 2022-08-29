<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Uri;

use DigipolisGent\Flanders\BasicRegisters\Filter\FiltersInterface;
use DigipolisGent\Flanders\BasicRegisters\Pager\PagerInterface;
use DigipolisGent\Flanders\BasicRegisters\Uri\AddressListUri;
use DigipolisGent\Tests\Flanders\BasicRegisters\TestCase;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Uri\AbstractUriWithQuery
 */
class AbstractUriWithQueryTest extends TestCase
{
    /**
     * URI without filters.
     *
     * @test
     */
    public function uriWithoutFilters(): void
    {
        $uri = new AddressListUri();
        $this->assertEquals('adressen', $uri->getUri());
    }

    /**
     * URI with only filters.
     *
     * @test
     */
    public function uriWithFilters(): void
    {
        $uri = AddressListUri::fromFilters(
            $this->createFiltersMock()
        );

        $this->assertSame(
            'adressen?biz=fuzz&baz=123',
            $uri->getUri()
        );
    }

    /**
     * Empty filter values need to be in the query.
     *
     * The empty value filters need to be in the query.
     *
     * @test
     */
    public function uriContainsKeysWithEmptyValues(): void
    {
        $filters = $this->prophesize(FiltersInterface::class);
        $filters
            ->filters()
            ->willReturn(
                [
                    'biz' => '',
                    'baz' => '',
                ]
            );

        $uri = AddressListUri::fromFilters($filters->reveal());

        $this->assertSame(
            'adressen?biz=&baz=',
            $uri->getUri()
        );
    }

    /**
     * URI with only pager.
     *
     * @test
     */
    public function uriWithPager(): void
    {
        $uri = AddressListUri::fromPager(
            $this->createPagerMock()
        );

        $this->assertSame(
            'adressen?offset=250&limit=50',
            $uri->getUri()
        );
    }

    /**
     * URI with filters and pager.
     *
     * @test
     */
    public function uriWithFiltersAndPager(): void
    {
        $uri = AddressListUri::fromFiltersAndPager(
            $this->createFiltersMock(),
            $this->createPagerMock()
        );

        $this->assertSame(
            'adressen?biz=fuzz&baz=123&offset=250&limit=50',
            $uri->getUri()
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
