<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Client;

use DigipolisGent\API\Client\AbstractClient;
use Psr\Http\Message\RequestInterface;

/**
 * Class ClientAbstract.
 */
final class Client extends AbstractClient
{
    /**
     * {@inheritdoc}
     *
     * This will add the user key if a value is set.
     */
    protected function injectHeaders(RequestInterface $request): RequestInterface
    {
        $request = parent::injectHeaders($request);

        $userKey = $this->configuration->userKey();
        if (!empty($userKey)) {
            $request = $request->withHeader('user-key', $userKey);
        }

        return $request;
    }
}
