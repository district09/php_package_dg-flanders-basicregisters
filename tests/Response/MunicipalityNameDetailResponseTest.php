<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Response;

use DigipolisGent\Flanders\BasicRegisters\Response\MunicipalityNameDetailResponse;
use DigipolisGent\Flanders\BasicRegisters\Value\Municipality\MunicipalityNameDetailInterface;
use DigipolisGent\Tests\Flanders\BasicRegisters\TestCase;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Response\MunicipalityNameDetailResponse
 */
class MunicipalityNameDetailResponseTest extends TestCase
{
    /**
     * Response is created with MunicipalityNameDetail value.
     *
     * @test
     */
    public function responseHasMunicipalityNameDetailValue(): void
    {
        $municipalityNameDetail = $this->prophesize(MunicipalityNameDetailInterface::class)->reveal();
        $response = new MunicipalityNameDetailResponse($municipalityNameDetail);

        $this->assertSame($municipalityNameDetail, $response->municipalityNameDetail());
    }
}
