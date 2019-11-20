<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Response;

use DigipolisGent\Flanders\BasicRegisters\Response\MunicipalityNamesResponse;
use DigipolisGent\Flanders\BasicRegisters\Value\Municipality\MunicipalityNames;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Response\MunicipalityNamesResponse
 */
class MunicipalityNamesResponseTest extends TestCase
{
    /**
     * Response is created with municipality names collection.
     *
     * @test
     */
    public function responseHasAddressesCollection(): void
    {
        $municipalityNames = new MunicipalityNames();
        $response = new MunicipalityNamesResponse($municipalityNames);

        $this->assertSame($municipalityNames, $response->municipalityNames());
    }
}
