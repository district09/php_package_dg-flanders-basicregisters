<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Pager;

use DigipolisGent\Flanders\BasicRegisters\Pager\Pager;
use DigipolisGent\Tests\Flanders\BasicRegisters\TestCase;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Pager\Pager
 */
class PagerTest extends TestCase
{
    /**
     * Pager can be created with default values.
     *
     * @test
     */
    public function pagerCanBeCreatedWithDefaultValues(): void
    {
        $pager = new Pager();
        $this->assertEquals(0, $pager->page());
        $this->assertEquals(0, $pager->offset());
        $this->assertEquals(20, $pager->limit());
    }

    /**
     * Pager can be created for a specific page.
     *
     * @test
     */
    public function pagerCanBeCreatedForSpecificPage(): void
    {
        $pager = new Pager(5, 50);
        $this->assertEquals(5, $pager->page());
        $this->assertEquals(250, $pager->offset());
        $this->assertEquals(50, $pager->limit());
    }

    /**
     * Query parameters can be retrieved from pager.
     *
     * @test
     */
    public function pagerCanBeCatedToQueryParameters(): void
    {
        $pager = new Pager(1, 25);
        $expected = [
            'offset' => 25,
            'limit' => 25,
        ];

        $this->assertEquals($expected, $pager->query());
    }
}
