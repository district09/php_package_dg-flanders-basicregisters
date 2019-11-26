<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Request;

use DigipolisGent\Flanders\BasicRegisters\Request\AddressDetailRequest;
use DigipolisGent\Flanders\BasicRegisters\Value\Address\AddressId;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Request\AddressDetailRequest
 */
class AddressDetailRequestTest extends TestCase
{
    /**
     * The URI is set.
     *
     * @test
     */
    public function requestUriIsSet(): void
    {
        $addressId = new AddressId(789456);
        $request = new AddressDetailRequest($addressId);

        $this->assertEquals('adressen/789456', $request->getRequestTarget());
    }
}
