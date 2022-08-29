<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Response;

use DigipolisGent\Flanders\BasicRegisters\Response\AddressDetailResponse;
use DigipolisGent\Flanders\BasicRegisters\Value\Address\AddressDetailInterface;
use DigipolisGent\Tests\Flanders\BasicRegisters\TestCase;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Response\AddressDetailResponse
 */
class AddressDetailResponseTest extends TestCase
{
    /**
     * Response is created with AddressDetail value.
     *
     * @test
     */
    public function responseHasAddressDetailValue(): void
    {
        $addressDetail = $this
            ->prophesize(AddressDetailInterface::class)
            ->reveal();
        $response = new AddressDetailResponse($addressDetail);

        $this->assertSame($addressDetail, $response->addressDetail());
    }
}
