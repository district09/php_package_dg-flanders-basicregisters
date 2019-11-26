<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Value\Address;

use DigipolisGent\Flanders\BasicRegisters\Value\Address\AddressMatches;
use DigipolisGent\Flanders\BasicRegisters\Value\Address\AddressMatchInterface;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Value\Address\AddressMatches
 */
class AddressMatchesTest extends TestCase
{
    /**
     * Casting to string returns all address as string.
     *
     * @test
     */
    public function castToStringReturnsAllAddressAsString(): void
    {
        $addressMatch1 = $this->createAddressMatchMock('Foo 123, 9123 Bar');
        $addressMatch2 = $this->createAddressMatchMock('Foo 124, 9123 Bar');
        $addressesMatches = new AddressMatches($addressMatch1, $addressMatch2);

        $this->assertEquals(
            'Foo 123, 9123 Bar; Foo 124, 9123 Bar',
            (string) $addressesMatches
        );
    }

    /**
     * Create an address match mock.
     *
     * @param string $toString
     *   The to string value.
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\Address\AddressMatchInterface
     */
    private function createAddressMatchMock(string $toString): AddressMatchInterface
    {
        $addressMatch = $this->prophesize(AddressMatchInterface::class);
        $addressMatch->__toString()->willReturn($toString);

        return $addressMatch->reveal();
    }
}
