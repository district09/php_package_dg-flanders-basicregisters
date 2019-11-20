<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Uri;

use DigipolisGent\Flanders\BasicRegisters\Uri\MunicipalityNamesUri;
use PHPStan\Testing\TestCase;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Uri\MunicipalityNamesUri
 */
class MunicipalityNamesUriTest extends TestCase
{
    /**
     * Basic path.
     *
     * @test
     */
    public function uriWithoutFilters(): void
    {
        $uri = new MunicipalityNamesUri();
        $this->assertEquals('gemeenten', $uri->getUri());
    }
}
