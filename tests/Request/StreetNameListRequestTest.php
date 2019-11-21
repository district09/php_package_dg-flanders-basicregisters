<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Request;

use DigipolisGent\Flanders\BasicRegisters\Request\StreetNameListRequest;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Request\StreetNameListRequest
 */
class StreetNameListRequestTest extends TestCase
{
    /**
     * The URI is set.
     *
     * @test
     */
    public function defaultUriWithoutFilters(): void
    {
        $request = new StreetNameListRequest();
        $this->assertEquals('straatnamen', $request->getRequestTarget());
    }
}
