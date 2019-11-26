<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Request;

use DigipolisGent\API\Client\Request\AbstractJsonRequest;
use DigipolisGent\Flanders\BasicRegisters\Pager\PagerInterface;
use DigipolisGent\Flanders\BasicRegisters\Uri\MunicipalityNameListUri;

/**
 * Request to get a list of municipality names.
 */
final class MunicipalityNameListRequest extends AbstractJsonRequest
{
    /**
     * Create a new municipality names request.
     *
     * @param \DigipolisGent\Flanders\BasicRegisters\Pager\PagerInterface|null $pager
     *   Optional pager to limit the list by.
     */
    public function __construct(?PagerInterface $pager = null)
    {
        $uri = MunicipalityNameListUri::fromPager($pager);

        parent::__construct($uri);
    }
}
