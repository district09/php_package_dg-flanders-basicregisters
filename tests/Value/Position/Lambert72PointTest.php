<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Value\Position;

use DigipolisGent\Flanders\BasicRegisters\Value\Position\Lambert72Point;
use DigipolisGent\Tests\Flanders\BasicRegisters\TestCase;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Value\Position\AbstractPoint
 * @covers \DigipolisGent\Flanders\BasicRegisters\Value\Position\Lambert72Point
 */
class Lambert72PointTest extends TestCase
{
    /**
     * Point can be created from x and y position.
     *
     * @test
     */
    public function pointCanBeCreatedFromXAndYPosition(): void
    {
        $point = new Lambert72Point(97000.00, 171000.00);
        $this->assertSame(97000.00, $point->xPosition());
        $this->assertSame(171000.00, $point->yPosition());
    }

    /**
     * Not the same value if X is different.
     *
     * @test
     */
    public function notSameIfXPositionIsNotIdentical(): void
    {
        $point = new Lambert72Point(10, 20);
        $otherPoint = new Lambert72Point(10.1, 20);

        $this->assertFalse($point->sameValueAs($otherPoint));
    }

    /**
     * Not the same value if Y is different.
     *
     * @test
     */
    public function notSameIfYPositionIsNotIdentical(): void
    {
        $point = new Lambert72Point(10, 20);
        $otherPoint = new Lambert72Point(10, 19.99);

        $this->assertFalse($point->sameValueAs($otherPoint));
    }

    /**
     * Same value if X and Y are identical.
     *
     * @test
     */
    public function sameIfXAndYPositionAreIdentical(): void
    {
        $point = new Lambert72Point(10, 20);
        $samePoint = new Lambert72Point(10, 20);

        $this->assertTrue($point->sameValueAs($samePoint));
    }

    /**
     * Cast to string results in x,y.
     *
     * @test
     */
    public function castToStringReturnsXYSeparatedByComma(): void
    {
        $point = new Lambert72Point(10.99, 20.01);
        $this->assertSame('10.99,20.01', (string) $point);
    }
}
