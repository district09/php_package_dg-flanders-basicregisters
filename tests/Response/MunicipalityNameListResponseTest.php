<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Response;

use DigipolisGent\Flanders\BasicRegisters\Response\MunicipalityNameListResponse;
use DigipolisGent\Flanders\BasicRegisters\Value\Municipality\MunicipalityNames;
use DigipolisGent\Tests\Flanders\BasicRegisters\TestCase;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Response\MunicipalityNameListResponse
 */
class MunicipalityNameListResponseTest extends TestCase
{
    /**
     * Response is created with municipality names collection.
     *
     * @test
     */
    public function responseHasAddressesCollection(): void
    {
        $municipalityNames = new MunicipalityNames();
        $response = new MunicipalityNameListResponse($municipalityNames);

        $this->assertSame($municipalityNames, $response->municipalityNames());
    }
}
