<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Request;

use DigipolisGent\Flanders\BasicRegisters\Request\MunicipalityNameDetailRequest;
use DigipolisGent\Flanders\BasicRegisters\Value\Municipality\MunicipalityNameId;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Request\MunicipalityNameDetailRequest
 */
class MunicipalityNameDetailRequestTest extends TestCase
{
    /**
     * The URI is set.
     *
     * @test
     */
    public function requestUriIsSet(): void
    {
        $municipalityNameId = new MunicipalityNameId(789456);
        $request = new MunicipalityNameDetailRequest($municipalityNameId);

        $this->assertEquals('gemeenten/789456', $request->getRequestTarget());
    }
}
