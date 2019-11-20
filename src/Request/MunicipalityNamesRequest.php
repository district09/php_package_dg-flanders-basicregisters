<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Request;

use DigipolisGent\API\Client\Request\AbstractRequest;
use DigipolisGent\Flanders\BasicRegisters\Pager\PagerInterface;
use DigipolisGent\Flanders\BasicRegisters\Uri\MunicipalityNamesUri;

/**
 * Request to get a list of municipality names.
 */
final class MunicipalityNamesRequest extends AbstractRequest
{
    /**
     * Create a new municipality names request.
     *
     * @param \DigipolisGent\Flanders\BasicRegisters\Pager\PagerInterface|null $pager
     *   Optional pager to limit the list by.
     */
    public function __construct(?PagerInterface $pager = null)
    {
        $uri = MunicipalityNamesUri::fromPager($pager);

        parent::__construct($uri);
    }
}
