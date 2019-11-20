<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Request;

use DigipolisGent\Flanders\BasicRegisters\Pager\PagerInterface;
use DigipolisGent\Flanders\BasicRegisters\Request\MunicipalityNamesRequest;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Request\MunicipalityNamesRequest
 */
class MunicipalityNamesRequestTest extends TestCase
{
    /**
     * The URI is set.
     *
     * @test
     */
    public function defaultUriWithoutFilters(): void
    {
        $request = new MunicipalityNamesRequest();
        $this->assertEquals('gemeenten', $request->getRequestTarget());
    }

    /**
     * Has URI with pager when pager is passed.
     *
     * @test
     */
    public function uriWithFiltersAndPager(): void
    {
        $request = new MunicipalityNamesRequest(
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
