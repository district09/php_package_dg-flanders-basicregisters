<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Request;

use DigipolisGent\API\Client\Request\AcceptType;
use DigipolisGent\API\Client\Request\MethodType;
use DigipolisGent\API\Client\Uri\UriInterface;
use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\RequestInterface;

/**
 * Abstract request.
 */
abstract class AbstractJsonRequest extends Request implements RequestInterface
{
    /**
     * Constructor.
     *
     * @param \DigipolisGent\API\Client\Uri\UriInterface $uri
     *   The URI for the request object.
     */
    public function __construct(UriInterface $uri)
    {
        parent::__construct(
            MethodType::GET,
            $uri->getUri(),
            ['Accept' => AcceptType::JSON]
        );
    }
}
