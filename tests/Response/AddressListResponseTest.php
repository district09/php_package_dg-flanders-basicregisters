<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Response;

use DigipolisGent\Flanders\BasicRegisters\Response\AddressListResponse;
use DigipolisGent\Flanders\BasicRegisters\Value\Address\Addresses;
use DigipolisGent\Tests\Flanders\BasicRegisters\TestCase;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Response\AddressListResponse
 */
class AddressListResponseTest extends TestCase
{
    /**
     * Response is created with Addresses collection.
     *
     * @test
     */
    public function responseHasAddressesCollection(): void
    {
        $addresses = new Addresses();
        $response = new AddressListResponse($addresses);

        $this->assertSame($addresses, $response->addresses());
    }
}
