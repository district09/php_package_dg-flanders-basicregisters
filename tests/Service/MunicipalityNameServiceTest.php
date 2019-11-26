<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Service;

use DigipolisGent\API\Client\ClientInterface;
use DigipolisGent\API\Client\Response\ResponseInterface;
use DigipolisGent\Flanders\BasicRegisters\Service\MunicipalityNameService;
use DigipolisGent\Flanders\BasicRegisters\Pager\PagerInterface;
use DigipolisGent\Flanders\BasicRegisters\Request\MunicipalityNameDetailRequest;
use DigipolisGent\Flanders\BasicRegisters\Request\MunicipalityNameListRequest;
use DigipolisGent\Flanders\BasicRegisters\Response\MunicipalityNameDetailResponse;
use DigipolisGent\Flanders\BasicRegisters\Response\MunicipalityNameListResponse;
use DigipolisGent\Flanders\BasicRegisters\Value\Municipality\MunicipalityNameDetailInterface;
use DigipolisGent\Flanders\BasicRegisters\Value\Municipality\MunicipalityNameId;
use DigipolisGent\Flanders\BasicRegisters\Value\Municipality\MunicipalityNames;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestInterface;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Service\MunicipalityNameService
 */
class MunicipalityNameServiceTest extends TestCase
{
    /**
     * Get the list of municipality names.
     *
     * @test
     */
    public function listReturnsMunicipalityNamesCollection(): void
    {
        $pager = $this->createPagerMock();

        $municipalityNames = new MunicipalityNames();
        $request = new MunicipalityNameListRequest($pager);
        $response = new MunicipalityNameListResponse($municipalityNames);

        $basicRegisters = new MunicipalityNameService(
            $this->createClientMock($request, $response)
        );

        $this->assertEquals($municipalityNames, $basicRegisters->list($pager));
    }

    /**
     * Get the municipality name details for a given municipality name ID.
     *
     * @test
     */
    public function detailReturnsMunicipalityNameDetailValue(): void
    {
        $municipalityNameId = new MunicipalityNameId(9731);
        $municipalityNameDetail = $this->prophesize(MunicipalityNameDetailInterface::class)->reveal();

        $request = new MunicipalityNameDetailRequest($municipalityNameId);
        $response = new MunicipalityNameDetailResponse($municipalityNameDetail);

        $basicRegisters = new MunicipalityNameService(
            $this->createClientMock($request, $response)
        );

        $this->assertEquals(
            $municipalityNameDetail,
            $basicRegisters->detail($municipalityNameId)
        );
    }

    /**
     * Create a client mock.
     *
     * @param \Psr\Http\Message\RequestInterface $request
     * @param \DigipolisGent\API\Client\Response\ResponseInterface $response
     *
     * @return \DigipolisGent\API\Client\ClientInterface
     */
    private function createClientMock(RequestInterface $request, ResponseInterface $response): ClientInterface
    {
        $client = $this->prophesize(ClientInterface::class);
        $client->send($request)->willReturn($response);

        return $client->reveal();
    }

    /**
     * Create empty pager mock.
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Pager\PagerInterface
     */
    private function createPagerMock(): PagerInterface
    {
        $pagerMock = $this->prophesize(PagerInterface::class);
        $pagerMock->query()->willReturn([]);

        return $pagerMock->reveal();
    }
}
