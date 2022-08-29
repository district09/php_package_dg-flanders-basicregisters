<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Uri;

use DigipolisGent\Flanders\BasicRegisters\Uri\AddressListUri;
use DigipolisGent\Tests\Flanders\BasicRegisters\TestCase;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Uri\AddressListUri
 */
class AddressListUriTest extends TestCase
{
    /**
     * Basic path.
     *
     * @test
     */
    public function uriWithoutFilters(): void
    {
        $uri = new AddressListUri();
        $this->assertEquals('adressen', $uri->getUri());
    }
}
