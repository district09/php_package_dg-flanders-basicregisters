<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Uri;

use DigipolisGent\Flanders\BasicRegisters\Uri\StreetNameDetailUri;
use DigipolisGent\Flanders\BasicRegisters\Value\Street\StreetNameId;
use DigipolisGent\Tests\Flanders\BasicRegisters\TestCase;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Uri\StreetNameDetailUri
 */
class StreetNameDetailUriTest extends TestCase
{
    /**
     * URI contains the ID of the address.
     *
     * @test
     */
    public function uriContainsAddressId(): void
    {
        $streetNameId = new StreetNameId(123456);
        $uri = new StreetNameDetailUri($streetNameId);

        $this->assertSame('straatnamen/123456', $uri->getUri());
    }
}
