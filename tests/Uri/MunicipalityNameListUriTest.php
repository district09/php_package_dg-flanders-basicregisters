<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Uri;

use DigipolisGent\Flanders\BasicRegisters\Uri\MunicipalityNameListUri;
use PHPStan\Testing\TestCase;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Uri\MunicipalityNameListUri
 */
class MunicipalityNameListUriTest extends TestCase
{
    /**
     * Basic path.
     *
     * @test
     */
    public function uriWithoutFilters(): void
    {
        $uri = new MunicipalityNameListUri();
        $this->assertEquals('gemeenten', $uri->getUri());
    }
}
