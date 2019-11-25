<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Response;

use DigipolisGent\API\Client\Response\ResponseInterface;
use DigipolisGent\Flanders\BasicRegisters\Value\Post\PostInfo;
use DigipolisGent\Flanders\BasicRegisters\Value\Post\PostInfoInterface;

/**
 * Response containing the post info detail value.
 */
final class PostInfoDetailResponse implements ResponseInterface
{
    /**
     * Post info detail value.
     *
     * @var \DigipolisGent\Flanders\BasicRegisters\Value\Post\PostInfoInterface
     */
    private $postInfo;

    /**
     * Constructor.
     *
     * @param \DigipolisGent\Flanders\BasicRegisters\Value\Post\PostInfoInterface $postInfo
     */
    public function __construct(PostInfoInterface $postInfo)
    {
        $this->postInfo = $postInfo;
    }

    /**
     * Get the post info details.
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\Post\PostInfoInterface
     */
    public function postInfo(): PostInfoInterface
    {
        return $this->postInfo;
    }
}
