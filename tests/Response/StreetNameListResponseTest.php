<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Response;

use DigipolisGent\Flanders\BasicRegisters\Response\StreetNameListResponse;
use DigipolisGent\Flanders\BasicRegisters\Value\Street\StreetNames;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Response\StreetNameListResponse
 */
class StreetNameListResponseTest extends TestCase
{
    /**
     * Response is created with StreetNames collection.
     *
     * @test
     */
    public function responseHasStreetNamesCollection(): void
    {
        $streetNames = new StreetNames();
        $response = new StreetNameListResponse($streetNames);

        $this->assertSame($streetNames, $response->streetNames());
    }
}
