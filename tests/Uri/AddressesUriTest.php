<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Uri;

use DigipolisGent\Flanders\BasicRegisters\Uri\AddressesUri;
use PHPStan\Testing\TestCase;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Uri\AddressesUri
 */
class AddressesUriTest extends TestCase
{
    /**
     * URI is "adressen".
     *
     * @test
     */
    public function defaultUri(): void
    {
        $uri = new AddressesUri();
        $this->assertEquals('adressen', $uri->getUri());
    }
}
