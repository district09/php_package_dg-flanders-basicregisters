<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Request;

use DigipolisGent\Flanders\BasicRegisters\Filter\FiltersInterface;
use DigipolisGent\Flanders\BasicRegisters\Request\AddressMatchRequest;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Request\AddressMatchRequest
 */
class AddressMatchRequestTest extends TestCase
{
    /**
     * The URI is set.
     *
     * @test
     */
    public function defaultUriWithoutFilters(): void
    {
        $request = new AddressMatchRequest();
        $this->assertEquals('adresmatch', $request->getRequestTarget());
    }

    /**
     * Has URI with query when filters are passed.
     *
     * @test
     */
    public function uriWithFiltersAndPager(): void
    {
        $request = new AddressMatchRequest(
            $this->createFiltersMock()
        );

        $this->assertEquals(
            'adresmatch?biz=fuzz&baz=123',
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
}
