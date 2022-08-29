<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Uri;

use DigipolisGent\Flanders\BasicRegisters\Uri\StreetNameListUri;
use DigipolisGent\Tests\Flanders\BasicRegisters\TestCase;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Uri\StreetNameListUri
 */
class StreetNameListUriTest extends TestCase
{
    /**
     * Basic path.
     *
     * @test
     */
    public function uriWithoutFilters(): void
    {
        $uri = new StreetNameListUri();
        $this->assertEquals('straatnamen', $uri->getUri());
    }
}
