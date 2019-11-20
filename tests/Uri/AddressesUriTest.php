<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Uri;

use DigipolisGent\Flanders\BasicRegisters\Filter\FiltersInterface;
use DigipolisGent\Flanders\BasicRegisters\Pager\PagerInterface;
use DigipolisGent\Flanders\BasicRegisters\Uri\AddressesUri;
use PHPStan\Testing\TestCase;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Uri\AbstractUriWithQuery
 * @covers \DigipolisGent\Flanders\BasicRegisters\Uri\AddressesUri
 */
class AddressesUriTest extends TestCase
{
    /**
     * URI without filters.
     *
     * @test
     */
    public function uriWithoutFilters(): void
    {
        $uri = new AddressesUri();
        $this->assertEquals('adressen', $uri->getUri());
    }

    /**
     * URI with only filters.
     *
     * @test
     */
    public function uriWithFilters(): void
    {
        $uri = AddressesUri::fromFilters(
            $this->createFiltersMock()
        );

        $this->assertSame(
            'adressen?biz=fuzz&baz=123',
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
        $uri = AddressesUri::fromPager(
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
        $uri = AddressesUri::fromFiltersAndPager(
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
