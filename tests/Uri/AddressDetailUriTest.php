<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Uri;

use DigipolisGent\Flanders\BasicRegisters\Uri\AddressDetailUri;
use DigipolisGent\Flanders\BasicRegisters\Value\Address\AddressId;
use DigipolisGent\Tests\Flanders\BasicRegisters\TestCase;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Uri\AddressDetailUri
 */
class AddressDetailUriTest extends TestCase
{
    /**
     * URI contains the ID of the address.
     *
     * @test
     */
    public function uriContainsAddressId(): void
    {
        $addressId = new AddressId(123456);
        $uri = new AddressDetailUri($addressId);

        $this->assertSame('adressen/123456', $uri->getUri());
    }
}
