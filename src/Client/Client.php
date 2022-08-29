<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Client;

use DigipolisGent\API\Client\AbstractClient;
use DigipolisGent\API\Client\Response\ResponseInterface;
use DigipolisGent\API\Logger\RequestLog;
use GuzzleHttp\Exception\ClientException;
use Psr\Http\Message\RequestInterface;

/**
 * Class ClientAbstract.
 */
final class Client extends AbstractClient
{
    /**
     * @inheritDoc
     *
     * We do want the exceptions being throwed by Guzzle bubble up.
     */
    public function send(RequestInterface $request): ResponseInterface
    {
        $psrRequest  = $this->injectHeaders($request);

        $this->log(new RequestLog($request));

        $handler = $this->getHandler($request);
        $psrResponse = $this->guzzle->send($psrRequest);

        return $handler->toResponse($psrResponse);
    }

    /**
     * @inheritdoc
     *
     * This will add the user key if a value is set.
     */
    protected function injectHeaders(RequestInterface $request): RequestInterface
    {
        $request = parent::injectHeaders($request);
        /** @var \DigipolisGent\Flanders\BasicRegisters\Configuration\ConfigurationInterface $configuration */
        $configuration = $this->configuration;
        $userKey = $configuration->userKey();
        if (!empty($userKey)) {
            $request = $request->withHeader('user-key', $userKey);
        }

        return $request;
    }
}
