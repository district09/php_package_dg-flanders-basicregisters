<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Request;

use DigipolisGent\Flanders\BasicRegisters\Pager\PagerInterface;
use DigipolisGent\Flanders\BasicRegisters\Request\MunicipalityNameListRequest;
use DigipolisGent\Tests\Flanders\BasicRegisters\TestCase;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Request\MunicipalityNameListRequest
 */
class MunicipalityNameListRequestTest extends TestCase
{
    /**
     * The URI is set.
     *
     * @test
     */
    public function defaultUriWithoutFilters(): void
    {
        $request = new MunicipalityNameListRequest();
        $this->assertEquals('gemeenten', $request->getRequestTarget());
    }

    /**
     * Has URI with pager when pager is passed.
     *
     * @test
     */
    public function uriWithFiltersAndPager(): void
    {
        $request = new MunicipalityNameListRequest(
            $this->createPagerMock()
        );

        $this->assertEquals(
            'gemeenten?offset=250&limit=50',
            $request->getRequestTarget()
        );
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
