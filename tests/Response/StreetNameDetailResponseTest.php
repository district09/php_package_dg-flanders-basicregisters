<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Response;

use DigipolisGent\Flanders\BasicRegisters\Response\StreetNameDetailResponse;
use DigipolisGent\Flanders\BasicRegisters\Value\Street\StreetNameDetailInterface;
use DigipolisGent\Tests\Flanders\BasicRegisters\TestCase;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Response\StreetNameDetailResponse
 */
class StreetNameDetailResponseTest extends TestCase
{
    /**
     * Response is created with StreetNameDetail value.
     *
     * @test
     */
    public function responseHasStreetNameDetailValue(): void
    {
        $streetNameDetail = $this
            ->prophesize(StreetNameDetailInterface::class)
            ->reveal();
        $response = new StreetNameDetailResponse($streetNameDetail);

        $this->assertSame($streetNameDetail, $response->streetNameDetail());
    }
}
