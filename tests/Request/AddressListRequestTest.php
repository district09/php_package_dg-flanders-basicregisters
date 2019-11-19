<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Request;

use DigipolisGent\Flanders\BasicRegisters\Request\AddressListRequest;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Request\AddressListRequest
 */
class AddressListRequestTest extends TestCase
{
    /**
     * The URI is set.
     *
     * @test
     */
    public function hasProperUri(): void
    {
        $request = new AddressListRequest();
        $this->assertEquals('adressen', $request->getRequestTarget());
    }
}
