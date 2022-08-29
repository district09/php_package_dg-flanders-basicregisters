<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Request;

use DigipolisGent\API\Client\Request\AcceptType;
use DigipolisGent\API\Client\Request\MethodType;
use DigipolisGent\Flanders\BasicRegisters\Request\AddressDetailRequest;
use DigipolisGent\Flanders\BasicRegisters\Value\Address\AddressId;
use DigipolisGent\Tests\Flanders\BasicRegisters\TestCase;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Request\AbstractJsonRequest
 */
class AbstractJsonRequestTest extends TestCase
{
    /**
     * The method and accept headers are set.
     *
     * @test
     */
    public function methodAndHeadersAreSetDuringConstruction(): void
    {
        $addressId = new AddressId(789456);
        $request = new AddressDetailRequest($addressId);

        $this->assertEquals(MethodType::GET, $request->getMethod());
        $this->assertEquals([AcceptType::JSON], $request->getHeader('Accept'));
    }
}
