<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Response;

use DigipolisGent\Flanders\BasicRegisters\Response\AddressMatchResponse;
use DigipolisGent\Flanders\BasicRegisters\Value\Address\AddressMatches;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Response\AddressMatchResponse
 */
class AddressMatchResponseTest extends TestCase
{
    /**
     * Response is created with Addresses collection.
     *
     * @test
     */
    public function responseHasAddressesCollection(): void
    {
        $addressMatches = new AddressMatches();
        $response = new AddressMatchResponse($addressMatches);

        $this->assertSame($addressMatches, $response->addressMatches());
    }
}
