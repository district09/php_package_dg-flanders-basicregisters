<?php

namespace DigipolisGent\Flanders\BasicRegisters\Service;

use DigipolisGent\API\Client\ClientInterface;
use DigipolisGent\Flanders\BasicRegisters\Handler\PostInfoDetailHandler;
use DigipolisGent\Flanders\BasicRegisters\Handler\PostInfoListHandler;

/**
 * Factory to get the PostInfo service methods.
 */
final class PostInfoServiceFactory
{
    /**
     * @param \DigipolisGent\API\Client\ClientInterface $client
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Service\PostInfoService
     */
    public static function create(ClientInterface $client): PostInfoService
    {
        $client->addHandler(new PostInfoListHandler());
        $client->addHandler(new PostInfoDetailHandler());

        return new PostInfoService($client);
    }
}
