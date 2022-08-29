<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Uri;

use DigipolisGent\Flanders\BasicRegisters\Uri\AddressMatchUri;
use DigipolisGent\Tests\Flanders\BasicRegisters\TestCase;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Uri\AddressMatchUri
 */
class AddressMatchUriTest extends TestCase
{
    /**
     * URI path.
     *
     * @test
     */
    public function uriPathIsSet(): void
    {
        $uri = new AddressMatchUri();
        $this->assertEquals('adresmatch', $uri->getUri());
    }
}
