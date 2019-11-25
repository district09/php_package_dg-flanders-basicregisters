<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Request;

use DigipolisGent\Flanders\BasicRegisters\Request\StreetNameDetailRequest;
use DigipolisGent\Flanders\BasicRegisters\Value\Street\StreetNameId;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Request\StreetNameDetailRequest
 */
class StreetNameDetailRequestTest extends TestCase
{
    /**
     * The URI is set.
     *
     * @test
     */
    public function requestUriIsSet(): void
    {
        $streetNameId = new StreetNameId(789456);
        $request = new StreetNameDetailRequest($streetNameId);

        $this->assertEquals('straatnamen/789456', $request->getRequestTarget());
    }
}
