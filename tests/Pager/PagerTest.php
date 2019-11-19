<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Pager;

use DigipolisGent\Flanders\BasicRegisters\Pager\Pager;
use PHPUnit\Framework\TestCase;

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
        $this->assertEquals(0, $pager->offset());
        $this->assertEquals(20, $pager->limit());
    }

    /**
     * Pager can be created with specific values.
     *
     * @test
     */
    public function pagerCanBeCreatedWithSpecificValues(): void
    {
        $pager = new Pager(5, 50);
        $this->assertEquals(5, $pager->offset());
        $this->assertEquals(50, $pager->limit());
    }
}
