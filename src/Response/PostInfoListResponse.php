<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Response;

use DigipolisGent\API\Client\Response\ResponseInterface;
use DigipolisGent\Flanders\BasicRegisters\Value\Post\PostInfos;

/**
 * Response containing the post info collection.
 */
final class PostInfoListResponse implements ResponseInterface
{
    /**
     * Post info collection.
     *
     * @var \DigipolisGent\Flanders\BasicRegisters\Value\Post\PostInfos
     */
    private $postInfos;

    /**
     * Constructor.
     *
     * @param \DigipolisGent\Flanders\BasicRegisters\Value\Post\PostInfos $postInfos
     */
    public function __construct(PostInfos $postInfos)
    {
        $this->postInfos = $postInfos;
    }

    /**
     * Get the street names collection.
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\Post\PostInfos
     */
    public function postInfos(): PostInfos
    {
        return $this->postInfos;
    }
}
