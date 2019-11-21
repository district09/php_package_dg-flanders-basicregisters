<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Uri;

use DigipolisGent\Flanders\BasicRegisters\Uri\MunicipalityNameDetailUri;
use DigipolisGent\Flanders\BasicRegisters\Value\Municipality\MunicipalityNameId;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Uri\MunicipalityNameDetailUri
 */
class MunicipalityNameUriTest extends TestCase
{

    /**
     * URI contains the ID of the municipality name.
     *
     * @test
     */
    public function uriContainsMunicipalityNameId(): void
    {
        $municipalityNameId = new MunicipalityNameId(123456);
        $uri = new MunicipalityNameDetailUri($municipalityNameId);

        $this->assertSame('gemeenten/123456', $uri->getUri());
    }
}
